<?php

declare(strict_types=1);

namespace Tests\Application\Request;

use App\Application\Command\SaveSearchCommand;
use App\Application\Request\SaveSearchRequest;
use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\Uuid;
use Tests\AbstractKernelTestCase;

class SaveSearchRequestTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_creates_command(): void
    {
        $request = new SaveSearchRequest();

        $id = new Uuid(null);
        $city = "Tarnów";
        $coordinates = new Coordinates(20.98698, 50.01381);
        $weatherDescription = new WeatherDescription("Cloudy", "It's cloudy today.");
        $weatherDetails = new WeatherDetails(15.2, 10.3, 18.7, 992, 30);
        $windDetails = new WindDetails(50.01, 30, 21.5);
        $cloudDetails = new CloudDetails(50);

        $request->city = $city;
        $request->longitude = $coordinates->getLongitude();
        $request->latitude = $coordinates->getLatitude();
        $request->shortDescription = $weatherDescription->getShort();
        $request->longDescription = $weatherDescription->getLong();
        $request->temperature = $weatherDetails->getTemperature();
        $request->temperatureMin = $weatherDetails->getTemperatureMin();
        $request->temperatureMax = $weatherDetails->getTemperatureMax();
        $request->pressure = $weatherDetails->getPressure();
        $request->humidity = $weatherDetails->getHumidity();
        $request->windSpeed = $windDetails->getSpeed();
        $request->windDirectionDegree = $windDetails->getDirectionDegree();
        $request->windGust = $windDetails->getGust();
        $request->cloudPercentage = $cloudDetails->getPercentage();

        /** @var SaveSearchCommand $command*/
        $command = $request->createCommand($id);

        $this->assertInstanceOf(SaveSearchCommand::class, $command);
        $this->assertEquals($id->getValue()->toString(), $command->getId());
        $this->assertEquals($city, $command->getCity());
        $this->assertEquals($coordinates, $command->getCoordinates());
        $this->assertEquals($weatherDescription, $command->getWeatherDescription());
        $this->assertEquals($weatherDetails, $command->getWeatherDetails());
        $this->assertEquals($windDetails, $command->getWindDetails());
        $this->assertEquals($cloudDetails, $command->getCloudDetails());
    }
}
