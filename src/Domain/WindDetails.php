<?php

declare(strict_types=1);

namespace App\Domain;

class WindDetails implements ArrayTransformableInterface
{
    /**
     * @var float
     */
    private $speed;

    /**
     * @var int
     */
    private $directionDegree;

    /**
     * @var float
     */
    private $gust;

    public function __construct(
        float $speed,
        int $directionDegree,
        float $gust
    ) {
        $this->speed = $speed;
        $this->directionDegree = $directionDegree;
        $this->gust = $gust;
    }

    public function getSpeed(): float
    {
        return $this->speed;
    }

    public function getDirectionDegree(): int
    {
        return $this->directionDegree;
    }

    public function getGust(): float
    {
        return $this->gust;
    }

    public function toArray(): array
    {
        return [
            'speed' => $this->speed,
            'direction' => $this->directionDegree,
            'gust' => $this->gust,
        ];
    }
}
