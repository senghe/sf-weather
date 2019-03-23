<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Infrastructure\QueryInterface;
use App\Infrastructure\QueryModelInterface;

interface ShowStatisticsQueryInterface extends QueryInterface
{
    public function getStatistics(): QueryModelInterface;
}
