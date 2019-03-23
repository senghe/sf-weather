<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\Http\HttpResponseInterface;

interface SearchServiceInterface
{
    public function checkWeatherOnPlace(float $latitude, float $longitude): HttpResponseInterface;
}
