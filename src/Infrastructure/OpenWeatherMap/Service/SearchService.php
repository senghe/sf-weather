<?php

declare(strict_types=1);

namespace App\Infrastructure\OpenWeatherMap\Service;

use App\Infrastructure\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    private $apiUrl;

    private $apiKey;

    public function __construct(string $apiUrl, string $apiKey)
    {
        $this->apiUrl = $apiUrl;
        $this->apiKey = $apiKey;
    }

    public function search(): void
    {
        // ?lat=50.01381&lon=20.98698&APPID=739f64dff99e662803ec9a6f6445af8d
    }
}
