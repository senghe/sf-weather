<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\CloudDetails;
use Tests\AbstractKernelTestCase;

class CloudDetailsTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_value_object_getters(): void
    {
        $percentage = 35;

        $cloudDetails = new CloudDetails($percentage);

        $this->assertEquals($percentage, $cloudDetails->getPercentage());
    }

    /**
     * @test
     */
    public function it_tests_value_object_array(): void
    {
        $percentage = 35;

        $cloudDetails = new CloudDetails($percentage);

        $expected = [
            'percentage' => $percentage,
        ];
        $this->assertEquals($expected, $cloudDetails->toArray());
    }
}
