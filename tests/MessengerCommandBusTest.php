<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Tuzex\Cqrs\Command;
use Tuzex\Cqrs\Exception\CommandHandlerNotFoundException;
use Tuzex\Cqrs\MessengerCommandBus;

final class MessengerCommandBusTest extends TestCase
{
    public function testItDispatchesCommandToMessageBus(): void
    {
        $command = $this->createMock(Command::class);
        $commandBus = new MessengerCommandBus($this->mockMessageBus($command));

        $commandBus->execute($command);
    }

    public function testItThrowsExceptionIfCommandHandlerNotExists(): void
    {
        $command = $this->createMock(Command::class);
        $commandBus = new MessengerCommandBus($this->mockMessageBus($command, false));

        $this->expectException(CommandHandlerNotFoundException::class);
        $commandBus->execute($command);
    }

    private function mockMessageBus(Command $command, bool $handle = true): MessageBusInterface
    {
        $messageBus = $this->createMock(MessageBusInterface::class);
        $dispatchMethod = $messageBus->expects($this->once())
            ->method('dispatch')
            ->willReturn(
                new Envelope($command)
            );

        if (!$handle) {
            $dispatchMethod->willThrowException(
                new CommandHandlerNotFoundException($command, new Exception())
            );
        }

        return $messageBus;
    }
}
