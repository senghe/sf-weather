<?php

declare(strict_types=1);

namespace App\Application\Request;

use App\Application\Command\SaveSearchCommand;
use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\CommandBus\CommandInterface;
use App\Infrastructure\CommandFactoryInterface;
use App\Infrastructure\RequestResolver\RequestInterface;
use App\Infrastructure\Uuid;

class SaveSearchRequest implements CommandFactoryInterface, RequestInterface
{
    /**
     * @var string
     */
    public $city;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var string
     */
    public $shortDescription;

    /**
     * @var string
     */
    public $longDescription;

    /**
     * @var float
     */
    public $temperature;

    /**
     * @var float
     */
    public $temperatureMin;

    /**
     * @var float
     */
    public $temperatureMax;

    /**
     * @var int
     */
    public $pressure;

    /**
     * @var int
     */
    public $humidity;

    /**
     * @var float
     */
    public $windSpeed;

    /**
     * @var int
     */
    public $windDirectionDegree;

    /**
     * @var float
     */
    public $windGust;

    /**
     * @var int
     */
    public $cloudPercentage;

    public function createCommand(Uuid $id): CommandInterface
    {
        return new SaveSearchCommand(
            $id->getValue()->toString(),
            $this->city,
            $this->createCoordinates(),
            $this->createWeatherDescription(),
            $this->createWeatherDetails(),
            $this->createWindDetails(),
            $this->createCloudDetails()
        );
    }

    private function createCoordinates(): Coordinates
    {
        $coordinates = new Coordinates(
            $this->longitude,
            $this->latitude
        );

        return $coordinates;
    }

    private function createWeatherDescription(): WeatherDescription
    {
        $weatherDescription = new WeatherDescription(
            $this->shortDescription,
            $this->longDescription
        );

        return $weatherDescription;
    }

    private function createWeatherDetails(): WeatherDetails
    {
        $weatherDetails = new WeatherDetails(
            $this->temperature,
            $this->temperatureMin,
            $this->temperatureMax,
            $this->pressure,
            $this->humidity
        );

        return $weatherDetails;
    }

    private function createWindDetails(): WindDetails
    {
        $windDetails = new WindDetails(
            $this->windSpeed,
            $this->windDirectionDegree,
            $this->windGust
        );

        return $windDetails;
    }

    private function createCloudDetails(): CloudDetails
    {
        $cloudDetails = new CloudDetails(
            $this->cloudPercentage
        );

        return $cloudDetails;
    }
}
