<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Exception;

use LogicException;
use Tuzex\Cqrs\Query;

final class QueryResultNotFoundException extends LogicException
{
    public function __construct(Query $query)
    {
        /*
         * @todo PHP8 => $query::class
         */
        parent::__construct(sprintf('Result from "%s" not found.', get_class($query)));
    }
}
