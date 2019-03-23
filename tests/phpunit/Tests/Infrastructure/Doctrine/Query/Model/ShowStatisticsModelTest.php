<?php

declare(strict_types=1);

namespace Test\Domain;

use App\Infrastructure\Doctrine\Query\Model\ShowStatisticsModel;
use Tests\AbstractKernelTestCase;

class ShowStatisticsModelTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_query_model(): void
    {
        $city = "Tarnów";
        $temperatureMin = 15.03;
        $temperatureMax = 17.3;

        $model = new ShowStatisticsModel(
            $city,
            $temperatureMin,
            $temperatureMax
        );

        $expected = [
            'mostPopularCity' => $city,
            'temperature' => [
                'min' => $temperatureMin,
                'max' => $temperatureMax,
            ],
        ];
        $this->assertEquals($expected, $model->toArray());
    }
}
