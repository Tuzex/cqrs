<?php

declare(strict_types=1);

namespace Tuzex\Cqrs;

use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Tuzex\Cqrs\Exception\QueryHandlerNotFoundException;
use Tuzex\Cqrs\Exception\QueryResultNotFoundException;

final class MessengerQueryBus implements QueryBus
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {}

    public function execute(Query $query): object
    {
        try {
            $envelope = $this->messageBus->dispatch($query);
        } catch (NoHandlerForMessageException $exception) {
            throw new QueryHandlerNotFoundException($query, $exception);
        }

        $stamp = $envelope->last(HandledStamp::class);
        if (!$stamp instanceof HandledStamp) {
            throw new QueryResultNotFoundException($query);
        }

        return $stamp->getResult();
    }
}
