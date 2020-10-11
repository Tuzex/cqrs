<?php

declare(strict_types=1);

namespace Tuzex\Cqrs;

interface QueryBus
{
    public function execute(Query $query): object;
}
