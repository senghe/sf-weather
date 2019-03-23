<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

class HttpResponse implements HttpResponseInterface
{
    /**
     * @var string
     */
    private $contents;

    /**
     * @var bool
     */
    private $isJson;

    /**
     * @var string|null
     */
    private $jsonData = null;

    public function __construct(string $contents)
    {
        $this->contents = $contents;
        $this->jsonData = \json_decode($contents);
        $this->isJson = $this->jsonData !== null;
    }

    public function isJson(): bool
    {
        return $this->isJson;
    }

    public function getJson()
    {
        return $this->jsonData;
    }

    public function getContent(): string
    {
        return $this->contents;
    }
}
