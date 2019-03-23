<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class InvalidServerResponseException extends \Exception
{
    public function __construct(string $key, int $code = 0, Throwable $previous = null)
    {
        $message = "Invalid server response: $key key not found";

        parent::__construct($message, $code, $previous);
    }

}
