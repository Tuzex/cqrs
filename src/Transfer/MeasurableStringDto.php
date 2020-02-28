<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

abstract class MeasurableStringDto implements StringDto
{
    public function measure(): int
    {
        return function_exists('mb_strlen') ? mb_strlen($this->getValue(), 'UTF-8') : strlen(utf8_decode($this->getValue()));
    }

    abstract public function getValue(): string;
}
