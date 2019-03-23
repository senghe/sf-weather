<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Domain\Entity\CityStatistics;
use App\Infrastructure\Uuid;

class CityStatisticsFactory extends AbstractFactory
{
    public function createCityStatistics(
        string $city,
        int $useCount
    ): CityStatistics {
        $id = (new Uuid(null))->getValue()->toString();

        return new CityStatistics(
            $id, $city, $useCount
        );
    }
}
