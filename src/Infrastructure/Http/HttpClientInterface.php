<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

interface HttpClientInterface
{
    public function configure(string $baseUri): void;

    public function fetch(string $url, array $queryParams): HttpResponseInterface;
}
