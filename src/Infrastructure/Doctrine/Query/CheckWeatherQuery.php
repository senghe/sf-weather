<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query;

use App\Application\Query\CheckWeatherQueryInterface;
use App\Domain\Exception\NotJsonResponseException;
use App\Infrastructure\Doctrine\Query\Model\CheckWeatherModel;
use App\Infrastructure\Http\HttpResponseInterface;
use App\Infrastructure\SearchServiceInterface;

class CheckWeatherQuery implements CheckWeatherQueryInterface
{
    /**
     * @var SearchServiceInterface
     */
    private $searchService;

    public function __construct(SearchServiceInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    public function checkWeatherOnPlace(float $longitude, float $latitude): CheckWeatherModel
    {
        $result = $this->searchService->checkWeatherOnPlace($longitude, $latitude);

        return $this->createViewModel($result);
    }

    /**
     * @throws NotJsonResponseException
     */
    private function createViewModel(HttpResponseInterface $response): CheckWeatherModel
    {
        if (!$response->isJson()) {
            throw new NotJsonResponseException();
        }
        $json = $response->getJson();

        return new CheckWeatherModel($json);
    }
}
