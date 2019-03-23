<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query\Model;

use App\Infrastructure\QueryModelInterface;

class ShowStatisticsModel implements QueryModelInterface
{
    /**
     * @var string
     */
    private $mostPopularCity;

    /**
     * @var float
     */
    private $temperatureMax;

    /**
     * @var float
     */
    private $temperatureMin;

    public function __construct(string $mostPopularCity, float $temperatureMin, float $temperatureMax)
    {
        $this->mostPopularCity = $mostPopularCity;
        $this->temperatureMin = $temperatureMin;
        $this->temperatureMax = $temperatureMax;
    }

    public function toArray(): array
    {
        return [
            'mostPopularCity' => $this->mostPopularCity,
            'temperature' => [
                'min' => $this->temperatureMin,
                'max' => $this->temperatureMax,
            ],
        ];
    }
}
