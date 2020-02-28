<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

abstract class EvaluableBooleanDto implements BooleanDto
{
    public function isTrue(): bool
    {
        return true === $this->getValue();
    }

    public function isFalse(): bool
    {
        return false === $this->isFalse();
    }

    abstract public function getValue(): bool;
}
