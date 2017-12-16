<?php

namespace Domktorymysli\Grenton\Model;

/**
 * Class Properties
 * @package Domktorymysli\Grenton\Model
 */
final class Properties
{

    /**
     * @var string
     */
    private $cluKey;

    /**
     * @var string
     */
    private $cluIv;

    /**
     * @var string
     */
    private $cluIp;

    /**
     * @var int
     */
    private $cluPort;

    /**
     * @return string
     */
    public function getCluKey()
    {
        return $this->cluKey;
    }

    /**
     * @param string $cluKey
     */
    public function setCluKey($cluKey)
    {
        $this->cluKey = $cluKey;
    }

    /**
     * @return string
     */
    public function getCluIv()
    {
        return $this->cluIv;
    }

    /**
     * @param string $cluIv
     */
    public function setCluIv($cluIv)
    {
        $this->cluIv = $cluIv;
    }

    /**
     * @return string
     */
    public function getCluIp()
    {
        return $this->cluIp;
    }

    /**
     * @param string $cluIp
     */
    public function setCluIp($cluIp)
    {
        $this->cluIp = $cluIp;
    }

    /**
     * @return int
     */
    public function getCluPort()
    {
        return $this->cluPort;
    }

    /**
     * @param int $cluPort
     */
    public function setCluPort($cluPort)
    {
        $this->cluPort = $cluPort;
    }
}
