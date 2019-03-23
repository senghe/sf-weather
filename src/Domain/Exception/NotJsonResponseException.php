<?php

declare(strict_types=1);

namespace App\Domain\Exception;

use Throwable;

class NotJsonResponseException extends \Exception
{
    public function __construct(int $code = 0, Throwable $previous = null)
    {
        $message = "Server returned response that is not JSON";

        parent::__construct($message, $code, $previous);
    }

}
