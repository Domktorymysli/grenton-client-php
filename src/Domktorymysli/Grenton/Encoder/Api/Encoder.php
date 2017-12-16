<?php

namespace Domktorymysli\Grenton\Encoder\Api;
use Domktorymysli\Grenton\Encoder\Api\Exception\GrentonEncoderException;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;

/**
 * Interface Encoder
 * @package Domktorymysli\Grenton\Encoder\Api
 */
interface Encoder
{

    /**
     * @param MessageEncoded $message
     * @return MessageDecoded
     *
     * @throws GrentonEncoderException
     */
    public function decode(MessageEncoded $message);

    /**
     * @param MessageDecoded $message
     * @return MessageEncoded
     *
     * @throws GrentonEncoderException
     */
    public function encode(MessageDecoded $message);

}