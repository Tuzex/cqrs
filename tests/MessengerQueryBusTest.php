<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Tuzex\Cqrs\Exception\QueryHandlerNotFoundException;
use Tuzex\Cqrs\Exception\QueryResultNotFoundException;
use Tuzex\Cqrs\MessengerQueryBus;
use Tuzex\Cqrs\Query;
use Tuzex\Cqrs\QueryHandler;

final class MessengerQueryBusTest extends TestCase
{
    public function testItReturnsQueryResult(): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus($this->mockMessageBus($query));

        $this->assertInstanceOf(Query::class, $queryBus->execute($query));
    }

    public function testItThrowsExceptionIfQueryHandlerNotExists(): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus($this->mockMessageBus($query, false));

        $this->expectException(QueryHandlerNotFoundException::class);
        $queryBus->execute($query);
    }

    public function testItThrowsExceptionIfQueryResultMissing(): void
    {
        $query = $this->createMock(Query::class);
        $queryBus = new MessengerQueryBus($this->mockMessageBus($query, true, false));

        $this->expectException(QueryResultNotFoundException::class);
        $queryBus->execute($query);
    }

    private function mockMessageBus(Query $query, bool $handle = true, bool $result = true): MessageBusInterface
    {
        $stamps = $result ? [new HandledStamp($query, QueryHandler::class)] : [];
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
}
