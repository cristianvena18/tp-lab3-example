<?php

namespace Infrastructure\CommandBus\Handler\CommandNameExtractor;

use League\Tactician\Exception\CanNotDetermineCommandNameException;
use League\Tactician\Handler\CommandNameExtractor\CommandNameExtractor as CommandNameExtractorInterface;

/**
 * Extract the name from the command class
 */
class CommandNameExtractor implements CommandNameExtractorInterface
{
    /**
     * Extract the name from a command
     *
     * @param object $command
     *
     * @return string
     *
     * @throws CannotDetermineCommandNameException
     */
    public function extract($command)
    {
        $commandName = get_class($command);

        if (!$commandName) {
            throw CannotDetermineCommandNameException::forCommand($command);
        }

        return $commandName;
    }
}


