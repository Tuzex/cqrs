<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Test;

use PHPUnit\Framework\TestCase;
use stdClass;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Tuzex\Cqrs\Exception\QueryHandlerNotFoundException;
use Tuzex\Cqrs\Exception\InvalidQueryResultException;
use Tuzex\Cqrs\MessengerQueryBus;
use Tuzex\Cqrs\Query;
use Tuzex\Cqrs\QueryHandler;

final class MessengerQueryBusTest extends TestCase
{
    public function testItReturnsQueryResult(): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus(
            $this->mockMessageBus($query, [$this->mockHandledStamp()])
        );

        $this->assertInstanceOf(stdClass::class, $queryBus->execute($query));
    }

    public function testItThrowsExceptionIfQueryHandlerNotExists(): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus($this->mockMessageBus($query, handle: false));

        $this->expectException(QueryHandlerNotFoundException::class);
        $queryBus->execute($query);
    }

    /**
     * @dataProvider provideInvalidStamps
     */
    public function testItThrowsExceptionIfQueryResultIsInvalid(array $stamps): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus($this->mockMessageBus($query, $stamps));

        $this->expectException(InvalidQueryResultException::class);
        $queryBus->execute($query);
    }

    public function provideInvalidStamps(): array
    {
        return [
            'not-exists' => [
                'stamps' => [],
            ],
            'invalid-type' => [
                'stamps' => [
                    $this->mockHandledStamp(valid: false),
                ],
            ],
        ];
    }

    private function mockMessageBus(Query $query, array $stamps = [], bool $handle = true): MessageBusInterface
    {
        $envelope = new Envelope($query, $stamps);

        $messageBus = $this->createMock(MessageBusInterface::class);
        $dispatchMethod = $messageBus->expects($this->once())
            ->method('dispatch')
            ->willReturn($envelope);

        if (!$handle) {
            $dispatchMethod->willThrowException(new NoHandlerForMessageException());
        }

        return $messageBus;
    }

    private function mockHandledStamp(bool $valid = true): HandledStamp
    {
        return new HandledStamp($valid ? new stdClass() : '', QueryHandler::class);
    }
}
