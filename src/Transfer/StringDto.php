<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

interface StringDto extends Dto
{
    public function getValue(): string;
}
