<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query;

use App\Domain\Entity\CityStatistics;
use App\Domain\Entity\SearchHistory;
use App\Infrastructure\Doctrine\Query\Model\ShowStatisticsQueryModel;
use App\Infrastructure\QueryInterface;
use App\Infrastructure\QueryModelInterface;
use App\Infrastructure\RequestResolver\RequestInterface;
use Doctrine\ORM\EntityManagerInterface;

class ShowStatisticsQuery implements QueryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function execute(RequestInterface $request): QueryModelInterface
    {
        $model = new ShowStatisticsQueryModel(
            $this->findMostPopularCity(),
            ...$this->fetchStatistics()
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

        return $queryBuilder->select('MAX(s.weatherDetails.temperatureMax) as temperatureMax, MIN(s.weatherDetails.temperatureMin) as temperatureMin')
            ->from(SearchHistory::class, 's')
            ->getQuery()
            ->getArrayResult();
    }
}
