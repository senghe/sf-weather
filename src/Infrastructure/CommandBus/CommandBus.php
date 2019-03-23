<?php

namespace App\Infrastructure\CommandBus;

use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus
{
    /**
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function dispatch(CommandInterface $command): void
    {
        $this->bus->dispatch($command);
    }
}
