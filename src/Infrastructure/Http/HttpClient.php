<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use GuzzleHttp\Client;

class HttpClient implements HttpClientInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    public function configure(string $baseUri): void
    {
        $this->httpClient = new Client([
            'base_uri' => $baseUri,
            'verify' => false,
        ]);
    }

    public function fetch(string $url, array $queryParams): HttpResponseInterface
    {
        $options = [
            'query' => $queryParams,
        ];
        $body = $this->httpClient->get($url, $options)
            ->getBody();

        return new HttpResponse($body->getContents());
    }
}
