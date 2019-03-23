<?php

declare(strict_types=1);

namespace Tests\Application\Factory;

use App\Application\Factory\CityStatisticsFactory;
use App\Domain\Entity\CityStatistics;
use Tests\AbstractKernelTestCase;

class CityStatisticsFactoryTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_creates_city_statistics_entity(): void
    {
        $factory = new CityStatisticsFactory();

        $cityName = "Tarnów";
        $useCount = 12;

        $entity = $factory->createCityStatistics($cityName, $useCount);

        $this->assertInstanceOf(CityStatistics::class, $entity);
        $this->assertEquals($cityName, $entity->getCity());
        $this->assertEquals($useCount, $entity->getUseCount());
    }
}
