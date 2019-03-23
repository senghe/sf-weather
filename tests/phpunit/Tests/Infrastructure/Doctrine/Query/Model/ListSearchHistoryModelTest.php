<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Domain\CloudDetails;
use App\Domain\Coordinates;
use App\Domain\WeatherDescription;
use App\Domain\WeatherDetails;
use App\Domain\WindDetails;
use App\Infrastructure\Doctrine\Query\Model\ListSearchHistoryModel;
use App\Infrastructure\Doctrine\Query\Model\SearchHistoryModel;
use Tests\AbstractKernelTestCase;

class ListSearchHistoryModelTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_query_model(): void
    {
        $city = "Tarnów";
        $coordinates = new Coordinates(20.98698, 50.01381);
        $weatherDescription = new WeatherDescription("Cloudy", "It's cloudy today.");
        $weatherDetails = new WeatherDetails(15.2, 10.3, 18.7, 992, 30);
        $windDetails = new WindDetails(50.01, 30, 21.5);
        $cloudDetails = new CloudDetails(50);

        $items = [
            new SearchHistoryModel(
                $city,
                $coordinates,
                $weatherDescription,
                $weatherDetails,
                $windDetails,
                $cloudDetails
            ),
        ];
        $total = 10;

        $model = new ListSearchHistoryModel($items, $total);

        $expected = [
            'total' => $total,
            'items' => [
                [
                    'city' => $city,
                    'coordinates' => $coordinates->toArray(),
                    'weatherDescription' => $weatherDescription->toArray(),
                    'weatherDetails' => $weatherDetails->toArray(),
                    'windDetails' => $windDetails->toArray(),
                    'cloudDetails' => $cloudDetails->toArray(),
                ]
            ],
        ];
        $this->assertEquals($expected, $model->toArray());
    }
}
