<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query;

use App\Application\Query\ShowStatisticsQueryInterface;
use App\Domain\Entity\CityStatistics;
use App\Domain\Entity\SearchHistory;
use App\Infrastructure\Doctrine\Query\Model\ShowStatisticsModel;
use App\Infrastructure\QueryModelInterface;
use Doctrine\ORM\EntityManagerInterface;

class ShowStatisticsQuery implements ShowStatisticsQueryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getStatistics(): QueryModelInterface
    {
        $tempStatistics = $this->fetchStatistics();
        $model = new ShowStatisticsModel(
            $this->findMostPopularCity(),
            (float)$tempStatistics['temperatureMin'],
            (float)$tempStatistics['temperatureMax']
        );

        return $model;
    }

    private function findMostPopularCity(): string
    {
        $queryBuilder = $this->entityManager
            ->createQueryBuilder();

        return $queryBuilder->select('s.city')
            ->from(CityStatistics::class, 's')
            ->orderBy('s.useCount', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private function fetchStatistics(): array
    {
        $queryBuilder = $this->entityManager
            ->createQueryBuilder();

        return $queryBuilder->select('MIN(s.weatherDetails.temperatureMin) as temperatureMin, MAX(s.weatherDetails.temperatureMax) as temperatureMax')
            ->from(SearchHistory::class, 's')
            ->getQuery()
            ->getSingleResult();
    }
}
