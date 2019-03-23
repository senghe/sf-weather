<?php

declare(strict_types=1);

namespace App\Domain;

class CloudDetails implements ArrayTransformableInterface
{
    /**
     * @var int
     */
    private $percentage;

    public function __construct(int $percentage)
    {
        $this->percentage = $percentage;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }

    public function toArray(): array
    {
        return [
            'percentage' => $this->percentage,
        ];
    }
}
