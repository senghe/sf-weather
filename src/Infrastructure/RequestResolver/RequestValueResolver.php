<?php

declare(strict_types=1);

namespace App\Infrastructure\RequestResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class RequestValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $interfaces = \class_implements($argument->getType());

        return \in_array($this->getSupportedClass(), $interfaces, true);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): ?\Generator
    {
        $params = $this->getRequestParams($request);
        $type = $argument->getType();

        $object = new $type();
        foreach ($params as $key => $value) {
            if (property_exists($type, $key)) {
                $object->{$key} = $value;
            }
        }

        yield $object;
    }

    private function getRequestParams(Request $request): array
    {
        $routeParams = $request->attributes->get('_route_params', []);
        if ($request->getMethod() == 'GET') {
            return array_merge($routeParams, $request->query->all());
        }

        return array_merge($routeParams, $request->request->all());
    }

    private function getSupportedClass(): string
    {
        return RequestInterface::class;
    }
}
