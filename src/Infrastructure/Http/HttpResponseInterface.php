<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

interface HttpResponseInterface
{
    public function isJson(): bool;

    public function getJson();

    public function getContent(): string;
}
