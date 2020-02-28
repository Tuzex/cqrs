<?php

declare(strict_types=1);

namespace Tuzex\Cqrs\Transfer;

interface ArrayDto extends Dto
{
    public function toArray(): array;
}
