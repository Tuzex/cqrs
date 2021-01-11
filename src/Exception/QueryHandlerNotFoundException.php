<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Exception;

use LogicException;
use Throwable;
use Tuzex\Cqrs\Query;

final class QueryHandlerNotFoundException extends LogicException
{
    public function __construct(Query $query, Throwable $previous)
    {
        parent::__construct(sprintf('Handler for query "%s" not found.', $query::class), $previous->getCode(), $previous);
    }
}
