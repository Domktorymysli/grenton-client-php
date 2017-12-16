<?php

namespace Domktorymysli\Grenton\Model;

/**
 * Class Clu
 * @package Domktorymysli\Grenton\Model
 */
final class Clu
{

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $ip;

    /**
     * Clu constructor.
     *
     * @param string $ip
     * @param int $port
     */
    public function __construct($ip, $port)
    {
        $this->port = $port;
        $this->ip = $ip;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }
}
