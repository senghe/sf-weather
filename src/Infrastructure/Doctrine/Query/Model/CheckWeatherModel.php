<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query\Model;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\Exception\InvalidServerResponseException;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\QueryModelInterface;

class CheckWeatherModel implements QueryModelInterface
{
    /**
     * @var object
     */
    private $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    /**
     * @throws InvalidServerResponseException
     */
    public function toArray(): array
    {
        $json = json_decode(json_encode($this->json), true);

        return (new SearchHistoryModel(
            $json['name'] ?? 'No city',
            $this->generateCoordinatesObject($json),
            $this->generateDescription($json),
            $this->generateWeatherDetails($json),
            $this->generateWindDetails($json),
            $this->generateCloudDetails($json)
        ))->toArray();
    }

    /**
     * @throws InvalidServerResponseException
     */
    private function generateCoordinatesObject(array $json): Coordinates
    {
        if (!isset($json['coord']['lon']) || !isset($json['coord']['lat'])) {
            throw new InvalidServerResponseException('coord');
        }

        $coordinates = new Coordinates(
            $json['coord']['lon'],
            $json['coord']['lat']
        );

        return $coordinates;
    }

    /**
     * @throws InvalidServerResponseException
     */
    private function generateDescription(array $json): WeatherDescription
    {
        if (!isset($json['weather'][0]['main']) || !isset($json['weather'][0]['description'])) {
            throw new InvalidServerResponseException('weather');
        }

        $weatherDescription = new WeatherDescription(
            $json['weather'][0]['main'],
            $json['weather'][0]['description']
        );

        return $weatherDescription;
    }

    /**
     * @throws InvalidServerResponseException
     */
    private function generateWeatherDetails(array $json): WeatherDetails
    {
        if (!isset($json['main']['temp'])
            || !isset($json['main']['temp_min'])
            || !isset($json['main']['temp_max'])
            || !isset($json['main']['pressure'])
            || !isset($json['main']['humidity'])
        ) {
            throw new InvalidServerResponseException('main');
        }

        $weatherDetails = new WeatherDetails(
            $json['main']['temp'],
            $json['main']['temp_min'],
            $json['main']['temp_max'],
            (int)$json['main']['pressure'],
            $json['main']['humidity']
        );

        return $weatherDetails;
    }

    /**
     * @throws InvalidServerResponseException
     */
    private function generateWindDetails(array $json): WindDetails
    {
        if (!isset($json['wind']['speed']) || !isset($json['wind']['deg'])) {
            throw new InvalidServerResponseException('wind');
        }

        $windDetails = new WindDetails(
            $json['wind']['speed'],
            (int)$json['wind']['deg'],
            $json['wind']['gust'] ?? 0.0
        );

        return $windDetails;
    }

    /**
     * @throws InvalidServerResponseException
     */
    private function generateCloudDetails(array $json): CloudDetails
    {
        if (!isset($json['clouds']['all'])) {
            throw new InvalidServerResponseException('clouds');
        }

        $cloudDetails = new CloudDetails(
            $json['clouds']['all']
        );

        return $cloudDetails;
    }
}
