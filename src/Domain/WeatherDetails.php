<?php

declare(strict_types=1);

namespace App\Domain;

class WeatherDetails implements ArrayTransformableInterface
{
    /**
     * @var float
     */
    private $temperature;

    /**
     * @var float
     */
    private $temperatureMin;

    /**
     * @var float
     */
    private $temperatureMax;

    /**
     * @var int
     */
    private $pressure;

    /**
     * @var int
     */
    private $humidity;

    public function __construct(
        float $temperature,
        float $temperatureMin,
        float $temperatureMax,
        int $pressure,
        int $humidity
    ) {
        $this->temperature = $temperature;
        $this->temperatureMin = $temperatureMin;
        $this->temperatureMax = $temperatureMax;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getTemperatureMin(): float
    {
        return $this->temperatureMin;
    }

    public function getTemperatureMax(): float
    {
        return $this->temperatureMax;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function toArray(): array
    {
        return [
            'current' => $this->temperature,
            'min' => $this->temperatureMin,
            'max' => $this->temperatureMax,
        ];
    }
}
