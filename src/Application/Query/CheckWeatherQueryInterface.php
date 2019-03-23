<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Infrastructure\Doctrine\Query\Model\CheckWeatherModel;
use App\Infrastructure\QueryInterface;

interface CheckWeatherQueryInterface extends QueryInterface
{
    public function checkWeatherOnPlace(float $longitude, float $latitude): CheckWeatherModel;
}
