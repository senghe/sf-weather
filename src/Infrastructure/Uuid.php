<?php

namespace App\Infrastructure;

use App\Domain\Exception\InvalidUuidException;
use Ramsey\Uuid\Uuid as UuidImplementation;
use Ramsey\Uuid\UuidInterface;

class Uuid
{
    /**
     * @var int
     */
    public const LENGTH = 36;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string|null $uuid
     * @throws InvalidUuidException
     * @throws \Exception
     */
    public function __construct(?string $uuid)
    {
        if ($uuid === null) {
            $this->value = UuidImplementation::uuid4();
        } else {
            if (UuidImplementation::isValid($uuid)) {
                $this->value = UuidImplementation::fromString($uuid);
            } else {
                throw new InvalidUuidException($uuid);
            }
        }
    }

    /**
     * @return UuidInterface
     */
    public function getValue(): UuidInterface
    {
        return $this->value;
    }
}