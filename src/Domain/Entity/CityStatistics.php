<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class CityStatistics
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $city;

    /**
     * @var int
     */
    private $useCount;

    public function __construct(string $id, string $city, int $useCount)
    {
        $this->id = $id;
        $this->city = $city;
        $this->useCount = $useCount;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function incrementUseCount(): void
    {
        $this->useCount++;
    }

    public function getUseCount(): int
    {
        return $this->useCount;
    }
}
