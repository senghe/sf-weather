<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\Entity\SearchHistory;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\Uuid;
use Tests\AbstractKernelTestCase;

class SearchHistoryTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_entity(): void
    {
        $id = (new Uuid(null))->getValue()->toString();
        $city = "Tarnów";
        $coordinates = new Coordinates(20.98698, 50.01381);
        $weatherDescription = new WeatherDescription("Cloudy", "It's cloudy today.");
        $weatherDetails = new WeatherDetails(15.2, 10.3, 18.7, 992, 30);
        $windDetails = new WindDetails(50.01, 30, 21.5);
        $cloudDetails = new CloudDetails(50);
        $createdAt = new \DateTime();

        $entity = new SearchHistory(
            $id,
            $city,
            $coordinates,
            $weatherDescription,
            $weatherDetails,
            $windDetails,
            $cloudDetails,
            $createdAt
        );

        $this->assertEquals($id, $entity->getId());
        $this->assertEquals($city, $entity->getCity());
        $this->assertEquals($coordinates, $entity->getCoordinates());
        $this->assertEquals($weatherDescription, $entity->getWeatherDescription());
        $this->assertEquals($weatherDetails, $entity->getWeatherDetails());
        $this->assertEquals($windDetails, $entity->getWindDetails());
        $this->assertEquals($cloudDetails, $entity->getCloudDetails());
    }
}
