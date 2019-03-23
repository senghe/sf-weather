<?php

declare(strict_types=1);

namespace App\Application\Request;

use App\Infrastructure\RequestResolver\RequestInterface;

class DoSearchRequest implements RequestInterface
{
    /**
     * @var float
     */
    public $longitude = 20.98698;

    /**
     * @var float
     */
    public $latitude = 50.01381;
}
