<?php


namespace Infrastructure\CommandBus;


use Infrastructure\CommandBus\Command\CommandInterface;

class CommandBus implements CommandBusInterface
{

    public function handle(CommandInterface $command): void
    {
        // TODO: Implement handle() method.
    }
}
