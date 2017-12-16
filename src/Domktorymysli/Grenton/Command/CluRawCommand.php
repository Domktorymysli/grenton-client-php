<?php

namespace Domktorymysli\Grenton\Command;

/**
 * Class CluRawCommand
 * @package Domktorymysli\Grenton\Command
 */
final class CluRawCommand extends CluCommandBase implements CluCommand
{

    /**
     * CluRawCommand constructor.
     * @param string $command
     */
    public function __construct($command)
    {
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @return string
     */
    public function getSessionId()
    {
        return "000001";
    }
}
