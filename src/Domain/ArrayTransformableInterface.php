<?php

declare(strict_types=1);

namespace App\Domain;

interface ArrayTransformableInterface
{
    public function toArray(): array;
}
