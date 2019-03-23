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
        
    }
}
