<?php

declare(strict_types=1);

namespace App\Application\Controller\Rest;

use App\Application\Query\CheckWeatherQueryInterface;
use App\Application\Request\DoSearchRequest;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractRestController
{
    /**
     * @Route(path="/search", methods={"GET"})
     */
    public function doSearch(DoSearchRequest $request, CheckWeatherQueryInterface $searchQuery)
    {
        $weather = $searchQuery->checkWeatherOnPlace($request->longitude, $request->latitude)
            ->toArray();

        return $this->jsonResponse($weather);
    }
}
