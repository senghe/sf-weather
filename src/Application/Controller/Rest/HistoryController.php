<?php

declare(strict_types=1);

namespace App\Application\Controller\Rest;

use App\Application\Request\ListSearchHistoryRequest;
use App\Application\Request\SaveSearchRequest;
use App\Infrastructure\CommandBus\CommandBus;
use App\Infrastructure\Doctrine\Query\SearchHistoryQuery;
use App\Infrastructure\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoryController extends AbstractRestController
{
    /**
     * @Route(path="/history", methods={"GET"})
     */
    public function listSearchHistory(
        ListSearchHistoryRequest $request,
        SearchHistoryQuery $query
    ) {
        $model = $query->findAll($request->page);
        return $this->jsonResponse($model->toArray(), Response::HTTP_OK);
    }

    /**
     * @Route(path="/history", methods={"POST"})
     */
    public function saveSearch(
        SaveSearchRequest $request,
        CommandBus $commandBus,
        SearchHistoryQuery $query
    ): JsonResponse {
        $id = new Uuid(null);
        $command = $request->createCommand($id);
        $commandBus->dispatch($command);

        return $this->jsonResponse($query->findOne($id)->toArray(), Response::HTTP_CREATED);
    }
}
