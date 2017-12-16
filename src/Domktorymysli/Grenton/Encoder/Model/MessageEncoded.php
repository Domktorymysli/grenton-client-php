<?php

namespace Domktorymysli\Grenton\Encoder\Model;

/**
 * Class MessageEncoded
 * @package Domktorymysli\Grenton\Encoder\Model
 */
final class MessageEncoded
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
     * MessageEncoded constructor.
     * @param $messageHolder
     * @param $messageLength
     */
    public function __construct($messageHolder, $messageLength)
    {
        $this->msg = $messageHolder;
        $this->length = $messageLength;
    }

    /**
     * @param string $s
     *
     * @return MessageEncoded
     */
    public static function createFromString($s)
    {
        $messageLength = strlen($s);
        $byteMessage = pack('H*', $s);

        return new MessageEncoded($byteMessage, $messageLength);
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
}
