<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query;

use App\Domain\Entity\SearchHistory;
use App\Infrastructure\Doctrine\Query\Model\ListSearchHistoryModel;
use App\Infrastructure\Doctrine\Query\Model\SearchHistoryModel;
use App\Infrastructure\QueryInterface;
use App\Infrastructure\QueryModelInterface;
use App\Infrastructure\Uuid;
use Doctrine\ORM\EntityManagerInterface;

class SearchHistoryQuery implements QueryInterface
{
    const ITEMS_PER_PAGE = 10;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(int $page): QueryModelInterface
    {
        if ($page < 1) {
            $page = 1;
        }

        $items = $this->findPaginated($page, self::ITEMS_PER_PAGE);
        $total = $this->getTotalCount();

        return new ListSearchHistoryModel($items, $total);
    }

    /**
     * @return SearchHistoryModel[]
     */
    private function findPaginated(int $page, int $itemsPerPage): array
    {
        $offset = $this->calculateOffset($page, $itemsPerPage);

        /** @var SearchHistory[] $queryResult */
        $queryResult = $this->entityManager->createQueryBuilder()
            ->select('h')
            ->from(SearchHistory::class, 'h')
            ->setFirstResult($offset)
            ->setMaxResults($itemsPerPage)
            ->orderBy('h.createdAt', 'DESC')
            ->getQuery()
            ->getResult();

        $return = [];
        foreach ($queryResult as $result) {
            $return[] = new SearchHistoryModel(
                $result->getCity(),
                $result->getCoordinates(),
                $result->getWeatherDescription(),
                $result->getWeatherDetails(),
                $result->getWindDetails(),
                $result->getCloudDetails()
            );
        }

        return $return;
    }

    private function calculateOffset(int $page, int $itemsPerPage): int
    {
        return ($page - 1) * $itemsPerPage;
    }

    private function getTotalCount(): int
    {
        return (int)$this->entityManager->createQueryBuilder()
            ->select('COUNT(h.id)')
            ->from(SearchHistory::class, 'h')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findOne(Uuid $id): ?SearchHistoryModel
    {
        $historyEntity = $this->entityManager->createQueryBuilder()
            ->select('h')
            ->from(SearchHistory::class, 'h')
            ->where('h.id = :id')
            ->setParameter('id', $id->getValue()->toString())
            ->getQuery()
            ->getOneOrNullResult();

        if ($historyEntity !== null) {
            return new SearchHistoryModel(
                $historyEntity->getCity(),
                $historyEntity->getCoordinates(),
                $historyEntity->getWeatherDescription(),
                $historyEntity->getWeatherDetails(),
                $historyEntity->getWindDetails(),
                $historyEntity->getCloudDetails()
            );
        }

        return null;
    }
}
