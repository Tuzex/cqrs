<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

interface IntegerDto extends Dto
{
    public function getValue(): int;
}
