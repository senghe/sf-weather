<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query\Model;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\QueryModelInterface;

class SearchHistoryModel implements QueryModelInterface
{
    /**
     * @var string
     */
    private $city;

    /**
     * @var Coordinates
     */
    private $coordinates;

    /**
     * @var WeatherDescription
     */
    private $weatherDescription;

    /**
     * @var WeatherDetails
     */
    private $weatherDetails;

    /**
     * @var WindDetails
     */
    private $windDetails;

    /**
     * @var CloudDetails
     */
    private $cloudDetails;

    public function __construct(
        string $city,
        Coordinates $coordinates,
        WeatherDescription $weatherDescription,
        WeatherDetails $weatherDetails,
        WindDetails $windDetails,
        CloudDetails $cloudDetails
    ) {
        $this->city = $city;
        $this->coordinates = $coordinates;
        $this->weatherDescription = $weatherDescription;
        $this->weatherDetails = $weatherDetails;
        $this->windDetails = $windDetails;
        $this->cloudDetails = $cloudDetails;
    }

    public function toArray(): array
    {
        return [
            'city' => $this->city,
            'coordinates' => $this->coordinates->toArray(),
            'weatherDescription' => $this->weatherDescription->toArray(),
            'weatherDetails' => $this->weatherDetails->toArray(),
            'windDetails' => $this->windDetails->toArray(),
            'cloudDetails' => $this->cloudDetails->toArray(),
        ];
    }
}
