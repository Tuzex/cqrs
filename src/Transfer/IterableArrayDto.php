<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

use ArrayIterator;
use Iterator;
use IteratorAggregate;

abstract class IterableArrayDto implements ArrayDto, IteratorAggregate
{
    public function getIterator(): Iterator
    {
        return new ArrayIterator($this->toArray());
    }

    abstract public function toArray(): array;
}
