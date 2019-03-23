<?php

declare(strict_types=1);

namespace App\Application\Factory;

use App\Application\Command\SaveSearchCommand;
use App\Domain\Entity\SearchHistory;

class SearchHistoryFactory extends AbstractFactory
{
    public function createSearchHistory(
        SaveSearchCommand $command
    ): SearchHistory {
        return new SearchHistory(
            $command->getId(),
            $command->getCity(),
            $command->getCoordinates(),
            $command->getWeatherDescription(),
            $command->getWeatherDetails(),
            $command->getWindDetails(),
            $command->getCloudDetails(),
            new \DateTimeImmutable()
        );
    }
}
