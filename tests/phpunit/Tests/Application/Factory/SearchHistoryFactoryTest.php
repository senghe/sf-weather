<?php

declare(strict_types=1);

namespace Tests\Application\Factory;

use App\Application\Command\SaveSearchCommand;
use App\Application\Factory\SearchHistoryFactory;
use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\Entity\SearchHistory;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\Uuid;
use Tests\AbstractKernelTestCase;

class SearchHistoryFactoryTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_creates_search_history_entity(): void
    {
        $factory = new SearchHistoryFactory();

        $id = (new Uuid(null))->getValue()->toString();
        $city = "Tarnów";
        $coordinates = new Coordinates(20.98698, 50.01381);
        $weatherDescription = new WeatherDescription("Cloudy", "It's cloudy today.");
        $weatherDetails = new WeatherDetails(15.2, 10.3, 18.7, 992, 30);
        $windDetails = new WindDetails(50.01, 30, 21.5);
        $cloudDetails = new CloudDetails(50);

        $command = new SaveSearchCommand(
            $id,
            $city,
            $coordinates,
            $weatherDescription,
            $weatherDetails,
            $windDetails,
            $cloudDetails
        );
        $entity = $factory->createSearchHistory($command);

        $this->assertInstanceOf(SearchHistory::class, $entity);
        $this->assertEquals($city, $entity->getCity());
        $this->assertEquals($coordinates, $entity->getCoordinates());
        $this->assertEquals($weatherDescription, $entity->getWeatherDescription());
        $this->assertEquals($weatherDetails, $entity->getWeatherDetails());
        $this->assertEquals($windDetails, $entity->getWindDetails());
        $this->assertEquals($cloudDetails, $entity->getCloudDetails());
    }
}
