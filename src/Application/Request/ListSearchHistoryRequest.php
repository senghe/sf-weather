<?php

declare(strict_types=1);

namespace App\Application\Request;

use App\Infrastructure\RequestResolver\RequestInterface;

class ListSearchHistoryRequest implements RequestInterface
{
    /**
     * @var int
     */
    public $page = 1;
}
