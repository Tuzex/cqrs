<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

interface FloatDto extends Dto
{
    public function getValue(): float;
}
