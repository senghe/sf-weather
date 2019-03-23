<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\CityStatistics;

interface CityStatisticsRepositoryInterface
{
    public function findByCity(string $city): ?CityStatistics;
}
