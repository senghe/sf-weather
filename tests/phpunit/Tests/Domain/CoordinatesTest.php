<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\Coordinates;
use Tests\AbstractKernelTestCase;

class CoordinatesTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_value_object_getters(): void
    {
        $longitude = 20.98698;
        $latitude = 50.01381;

        $coordinates = new Coordinates($longitude, $latitude);

        $this->assertEquals($longitude, $coordinates->getLongitude());
        $this->assertEquals($latitude, $coordinates->getLatitude());
    }

    /**
     * @test
     */
    public function it_tests_value_object_array(): void
    {
        $longitude = 20.98698;
        $latitude = 50.01381;

        $coordinates = new Coordinates($longitude, $latitude);

        $expected = [
            'longitude' => $longitude,
            'latitude' => $latitude,
        ];
        $this->assertEquals($expected, $coordinates->toArray());
    }
}
