<?php

declare(strict_types=1);

namespace App\Infrastructure\OpenWeatherMap\Service;

use App\Infrastructure\Http\HttpClientInterface;
use App\Infrastructure\Http\HttpResponseInterface;
use App\Infrastructure\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    /**
     * @var string
     */
    private $apiUrl;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $callUrl = '/data/2.5/weather';

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(string $apiUrl, string $apiKey, HttpClientInterface $httpClient)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    public function checkWeatherOnPlace(float $latitude, float $longitude): HttpResponseInterface
    {
        $this->httpClient->configure($this->apiUrl);

        $data = [
            'lat' => $latitude,
            'lon' => $longitude,
            'APPID' => $this->apiKey,
        ];

        return $this->httpClient->fetch($this->apiUrl.$this->callUrl, $data);
    }
}
