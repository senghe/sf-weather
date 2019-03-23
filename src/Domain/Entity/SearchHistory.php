<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;

class SearchHistory
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

    /**
     * @var \DateTimeInterface
     */
    private $createdAt;

    public function __construct(
        string $uuid,
        string $city,
        Coordinates $coordinates,
        WeatherDescription $weatherDescription,
        WeatherDetails $weatherDetails,
        WindDetails $windDetails,
        CloudDetails $cloudDetails,
        \DateTimeInterface $createdAt
    ) {
        $this->id = $uuid;
        $this->city = $city;
        $this->coordinates = $coordinates;
        $this->weatherDescription = $weatherDescription;
        $this->weatherDetails = $weatherDetails;
        $this->windDetails = $windDetails;
        $this->cloudDetails = $cloudDetails;
        $this->createdAt = $createdAt;
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

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }
}
