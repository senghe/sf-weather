<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\WeatherDetails;
use Tests\AbstractKernelTestCase;

class WeatherDetailsTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_value_object_getters(): void
    {
        $temperature = 15.01;
        $temperatureMin = 13.2;
        $temperatureMax = 17.05;
        $pressure = 1002;
        $humidity = 30;

        $details = new WeatherDetails($temperature, $temperatureMin, $temperatureMax, $pressure, $humidity);

        $this->assertEquals($temperature, $details->getTemperature());
        $this->assertEquals($temperatureMax, $details->getTemperatureMax());
        $this->assertEquals($temperatureMin, $details->getTemperatureMin());
        $this->assertEquals($pressure, $details->getPressure());
        $this->assertEquals($humidity, $details->getHumidity());
    }

    /**
     * @test
     */
    public function it_tests_value_object_array(): void
    {
        $temperature = 15.01;
        $temperatureMin = 13.2;
        $temperatureMax = 17.05;
        $pressure = 1002;
        $humidity = 30;

        $details = new WeatherDetails($temperature, $temperatureMin, $temperatureMax, $pressure, $humidity);

        $expected = [
            'current' => $temperature,
            'min' => $temperatureMin,
            'max' => $temperatureMax,
            'pressure' => $pressure,
            'humidity' => $humidity,
        ];
        $this->assertEquals($expected, $details->toArray());
    }
}
