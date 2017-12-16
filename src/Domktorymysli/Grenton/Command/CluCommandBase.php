<?php

namespace Domktorymysli\Grenton\Command;

/**
 * Class CluCommandBase
 * @package Domktorymysli\Grenton\Command
 */
abstract class CluCommandBase implements CluCommand
{

    /**
     * @var string
     */
    protected $type = "error";

    /**
     * @var string
     */
    protected $ip = "";

    /**
     * @var string
     */
    protected $body = "";

    /**
     * @var string
     */
    protected $sessionId = "";

    /**
     * @var string
     */
    protected $command = "";

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @inheritdoc
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @inheritdoc
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @inheritdoc
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function getCommand()
    {
        return $this->command;
    }
}
