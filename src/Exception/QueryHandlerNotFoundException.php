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
        /*
         * @todo PHP8 => $query::class
         */
        parent::__construct(sprintf('Handler for query "%s" not found.', get_class($query)), $previous->getCode(), $previous);
    }
}
