<?php

declare(strict_types=1);

namespace App\Application\Controller\Rest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AbstractRestController extends AbstractController
{
    public function jsonResponse($data, int $status = Response::HTTP_OK, array $serializationContext = []): JsonResponse
    {
        return JsonResponse::fromJsonString(
            $this->container->get('serializer')->serialize($data, 'json', $serializationContext),
            $status
        );
    }
}
