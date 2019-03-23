<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\WindDetails;
use Tests\AbstractKernelTestCase;

class WindDetailsTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_value_object_getters(): void
    {
        $speed = 35.42;
        $direction = 50;
        $gust = 14.02;

        $details = new WindDetails($speed, $direction, $gust);

        $this->assertEquals($speed, $details->getSpeed());
        $this->assertEquals($direction, $details->getDirectionDegree());
        $this->assertEquals($gust, $details->getGust());
    }

    /**
     * @test
     */
    public function it_tests_value_object_array(): void
    {
        $speed = 35.42;
        $direction = 50;
        $gust = 14.02;

        $details = new WindDetails($speed, $direction, $gust);

        $expected = [
            'speed' => $speed,
            'direction' => $direction,
            'gust' => $gust,
        ];
        $this->assertEquals($expected, $details->toArray());
    }
}
