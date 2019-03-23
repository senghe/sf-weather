<?php

declare(strict_types=1);

namespace Tests;

use App\Infrastructure\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AbstractKernelTestCase extends KernelTestCase
{
    /**
     * @return string
     * @throws \App\Domain\Exception\InvalidUuidException
     */
    protected function generateId(): string
    {
        return (new Uuid(null))->getValue()->toString();
    }
}