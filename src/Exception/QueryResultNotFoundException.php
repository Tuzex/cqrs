<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Exception;

use LogicException;
use Tuzex\Cqrs\Query;

final class QueryResultNotFoundException extends LogicException
{
    public function __construct(Query $query)
    {
        parent::__construct(sprintf('Result from "%s" not found.', $query::class));
    }
}
