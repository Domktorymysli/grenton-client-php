<?php

namespace Domktorymysli\Grenton\Encoder;

use Domktorymysli\Grenton\Encoder\Model\CipherKey;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;

/**
 * Class Encoder
 * @package Domktorymysli\Grenton\Encoder
 *
 **/
final class Encoder
{
    private static $OPENSSL_CIPHER_NAME = "aes-128-cbc";

    /**
     * @var CipherKey
     */
    private $cipherKey;

    /**
     * Encoder constructor.
     * @param CipherKey $cipherKey
     */
    public function __construct(CipherKey $cipherKey)
    {
        $this->cipherKey = $cipherKey;
    }

    /**
     * @param MessageDecoded $message
     * @return MessageEncoded
     */
    public function encode(MessageDecoded $message) {

        $encoded = openssl_encrypt(
            $message->getMsg(),
            Encoder::$OPENSSL_CIPHER_NAME,
            $this->cipherKey->getKey(),
            OPENSSL_RAW_DATA,
            $this->cipherKey->getIv()
        );

        return new MessageEncoded($encoded, $message->getLength());
    }

}
