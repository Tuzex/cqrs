<?php

declare(strict_types=1);

namespace Tuzex\Cqrs;

use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Tuzex\Cqrs\Exception\CommandHandlerNotFoundException;

final class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function execute(Command $command): void
    {
        try {
            $this->messageBus->dispatch($command);
        } catch (NoHandlerForMessageException $exception) {
            throw new CommandHandlerNotFoundException($command, $exception);
        }
    }
}
