<?php

declare(strict_types=1);

namespace App\Domain;

use App\Infrastructure\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class AbstractId
{
    /**
     * @var UuidInterface
     */
    private $uuid;

    public function __construct(?string $uuid)
    {
        if ($uuid === null) {
            $this->uuid = (new Uuid(null))->getValue();
        } else {
            $this->uuid = (new Uuid($uuid))->getValue();
        }
    }
}