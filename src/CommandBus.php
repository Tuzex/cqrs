<?php

declare(strict_types=1);

namespace Tuzex\Cqrs;

interface CommandBus
{
    public function dispatch(Command $command): void;
}
