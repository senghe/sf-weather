<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Infrastructure\Uuid;

abstract class AbstractFactory
{
    protected function generateNewUuid(): string
    {
        return (new Uuid(null))->getValue()->toString();
    }
}