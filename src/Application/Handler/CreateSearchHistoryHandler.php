<?php

declare(strict_types=1);

namespace App\Application\Handler;

use App\Application\Factory\CityStatisticsFactory;
use App\Application\Factory\SearchHistoryFactory;
use App\Application\Command\SaveSearchCommand;
use App\Domain\Entity\SearchHistory;
use App\Domain\Repository\CityStatisticsRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class CreateSearchHistoryHandler implements MessageHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var SearchHistoryFactory
     */
    private $searchHistoryFactory;

    /**
     * @var CityStatisticsRepositoryInterface
     */
    private $cityStatisticsRepository;

    /**
     * @var CityStatisticsFactory
     */
    private $cityStatisticsFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        SearchHistoryFactory $searchHistory,
        CityStatisticsFactory $cityStatisticsFactory,
        CityStatisticsRepositoryInterface $cityStatisticsRepository
    ) {
        $this->entityManager = $entityManager;
        $this->searchHistoryFactory = $searchHistory;
        $this->cityStatisticsFactory = $cityStatisticsFactory;
        $this->cityStatisticsRepository = $cityStatisticsRepository;
    }

    public function __invoke(SaveSearchCommand $command): void
    {
        $search = $this->searchHistoryFactory->createSearchHistory($command);
        $this->saveSearch($search);

        // @todo: EventBus
        $this->incrementCityUseCount($command->getCity());

        $this->entityManager->flush();
    }

    private function saveSearch(SearchHistory $history): void
    {
        $this->entityManager->persist($history);
    }

    private function incrementCityUseCount(string $city): void
    {
        $entity = $this->cityStatisticsRepository->findByCity($city);
        if ($entity === null) {
            $entity = $this->cityStatisticsFactory->createCityStatistics($city, 1);
        }

        $entity->incrementUseCount();
        $this->entityManager->persist($entity);
    }
}
