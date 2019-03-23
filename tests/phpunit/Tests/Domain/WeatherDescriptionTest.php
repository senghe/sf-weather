<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\WeatherDescription;
use Tests\AbstractKernelTestCase;

class WeatherDescriptionTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_value_object_getters(): void
    {
        $short = "Cloudy";
        $long = "It's cloudy today.";

        $description = new WeatherDescription($short, $long);

        $this->assertEquals($short, $description->getShort());
        $this->assertEquals($long, $description->getLong());
    }

    /**
     * @test
     */
    public function it_tests_value_object_array(): void
    {
        $short = "Cloudy";
        $long = "It's cloudy today.";

        $description = new WeatherDescription($short, $long);

        $expected = [
            'short' => $short,
            'long' => $long,
        ];
        $this->assertEquals($expected, $description->toArray());
    }
}
