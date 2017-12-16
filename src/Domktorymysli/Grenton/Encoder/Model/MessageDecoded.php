<?php

namespace Domktorymysli\Grenton\Encoder\Model;

/**
 * Class MessageDecoded
 * @package Encoder\Model
 */
final class MessageDecoded
{

    /**
     * @var string
     */
    private $msg;

    /**
     * @var int
     */
    private $length;

    /**
     * MessageDecoded constructor.
     * @param string $msg
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
        $this->length = strlen($msg);
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->msg;
    }

}
