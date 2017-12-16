<?php

namespace Domktorymysli\Grenton\Encoder\Api;

use Domktorymysli\Grenton\Encoder\Decoder;
use Domktorymysli\Grenton\Encoder\Model\CipherKey;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;

/**
 * Class EncoderGrenton
 * @package Domktorymysli\Grenton\Encoder\Api
 */
final class EncoderGrenton implements Encoder
{

    /**
     * @var Decoder
     */
    private $decoder;

    /**
     * @var \Domktorymysli\Grenton\Encoder\Encoder
     */
    private $encoder;

    /**
     * EncoderGrenton constructor.
     * @param string $key
     * @param string $iv
     */
    public function __construct($key, $iv)
    {
        $cipherKey = CipherKey::createFromString($key, $iv);
        $this->decoder = new Decoder($cipherKey);
        $this->encoder = new \Domktorymysli\Grenton\Encoder\Encoder($cipherKey);
    }


    /**
     * @inheritdoc
     */
    public function decode(MessageEncoded $message)
    {
        return $this->decoder->decode($message);
    }

    /**
     * @inheritdoc
     */
    public function encode(MessageDecoded $message)
    {
        return $this->encoder->encode($message);
    }
}
