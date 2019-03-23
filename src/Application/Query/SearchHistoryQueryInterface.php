<?php

declare(strict_types=1);

namespace App\Application\Query;

use App\Infrastructure\Doctrine\Query\Model\SearchHistoryModel;
use App\Infrastructure\QueryInterface;
use App\Infrastructure\QueryModelInterface;
use App\Infrastructure\Uuid;

interface SearchHistoryQueryInterface extends QueryInterface
{
    public function findAll(int $page): QueryModelInterface;

    public function findOne(Uuid $id): ?SearchHistoryModel;
}
