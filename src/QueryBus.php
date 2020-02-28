<?php

declare(strict_types=1);

namespace Tuzex\Cqrs;

use Tuzex\Cqrs\Transfer\Dto;

interface QueryBus
{
    public function execute(Query $query): Dto;
}
