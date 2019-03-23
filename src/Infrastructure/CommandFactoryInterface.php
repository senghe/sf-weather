<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\CommandBus\CommandInterface;

interface CommandFactoryInterface
{
    public function createCommand(Uuid $id): CommandInterface;
}
