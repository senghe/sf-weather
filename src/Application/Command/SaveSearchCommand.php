<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\CommandBus\CommandInterface;

class SaveSearchCommand implements CommandInterface
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
        string $id,
        string $city,
        Coordinates $coordinates,
        WeatherDescription $weatherDescription,
        WeatherDetails $weatherDetails,
        WindDetails $windDetails,
        CloudDetails $cloudDetails
    ) {
        $this->id = $id;
        $this->city = $city;
        $this->coordinates = $coordinates;
        $this->weatherDescription = $weatherDescription;
        $this->weatherDetails = $weatherDetails;
        $this->windDetails = $windDetails;
        $this->cloudDetails = $cloudDetails;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function getWeatherDescription(): WeatherDescription
    {
        return $this->weatherDescription;
    }

    public function getWeatherDetails(): WeatherDetails
    {
        return $this->weatherDetails;
    }

    public function getWindDetails(): WindDetails
    {
        return $this->windDetails;
    }

    public function getCloudDetails(): CloudDetails
    {
        return $this->cloudDetails;
    }
}
