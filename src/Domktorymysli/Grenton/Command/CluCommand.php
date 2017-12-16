<?php

namespace Domktorymysli\Grenton\Command;

/**
 * Interface CluCommand
 * @package Domktorymysli\Grenton\Command
 */
interface CluCommand
{
    const PATTERN = "#(req|resp)\\:([0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3})\\:([a-z0-9]{6,8})\\:(.*)#";

    /**
     * @return string
     */
    public function getCommand();

    /**
     * @return string
     */
    public function getSessionId();

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return string
     */
    public function getIp();

}
