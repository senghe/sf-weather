<?php

declare(strict_types=1);

namespace Tests\Domain\Entity;

use App\Domain\Entity\CityStatistics;
use App\Infrastructure\Uuid;
use Tests\AbstractKernelTestCase;

class CityStatisticsTest extends AbstractKernelTestCase
{
    /**
     * @test
     */
    public function it_tests_entity(): void
    {
        $id = (new Uuid(null))->getValue()->toString();
        $city = "Tarnów";
        $useCount = 12;
        $entity = new CityStatistics($id, $city, $useCount);

        $this->assertEquals($id, $entity->getId());
        $this->assertEquals($city, $entity->getCity());
        $this->assertEquals($useCount, $entity->getUseCount());
    }
}
