<?php

declare(strict_types=1);

namespace App\Domain;

class WeatherDescription implements ArrayTransformableInterface
{
    /**
     * @var string
     */
    private $short;

    /**
     * @var string
     */
    private $long;

    public function __construct(string $short, string $long)
    {
        $this->short = $short;
        $this->long = $long;
    }

    public function getShort(): string
    {
        return $this->short;
    }

    public function getLong(): string
    {
        return $this->long;
    }

    public function toArray(): array
    {
        return [
            'short' => $this->short,
            'long' => $this->long,
        ];
    }
}
