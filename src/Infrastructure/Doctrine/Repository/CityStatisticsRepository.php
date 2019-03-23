<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\CityStatistics;
use App\Domain\Repository\CityStatisticsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CityStatisticsRepository extends ServiceEntityRepository implements CityStatisticsRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CityStatistics::class);
    }

    public function findByCity(string $city): ?CityStatistics
    {
        return $this->findOneBy(['city' => $city]);
    }
}
