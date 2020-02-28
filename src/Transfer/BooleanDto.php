<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

interface BooleanDto extends Dto
{
    public function getValue(): bool;
}
