<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Query\Model;

use App\Infrastructure\QueryModelInterface;

class ListSearchHistoryModel implements QueryModelInterface
{
    /**
     * @var SearchHistoryModel[]
     */
    private $items;

    /**
     * @var int
     */
    private $total;

    /**
     * @param SearchHistoryModel[] $items
     */
    public function __construct(array $items, int $total)
    {
        $this->items = $items;
        $this->total = $total;
    }

    public function toArray(): array
    {
        $arrayItems = [];
        foreach ($this->items as $item) {
            $arrayItems[] = $item->toArray();
        }

        return [
            'total' => $this->total,
            'items' => $arrayItems,
        ];
    }
}
