<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class InvalidUuidException extends \Exception
{
    public function __construct(string $uuid, int $code = 0, Throwable $previous = null)
    {
        $message = "Invalid Uuid ".$uuid;

        parent::__construct($message, $code, $previous);
    }

}