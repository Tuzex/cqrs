<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

use Countable;

abstract class CountableArrayDto implements ArrayDto, Countable
{
    public function count(): int
    {
        return count($this->toArray());
    }

    abstract public function toArray(): array;
}
