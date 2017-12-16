<?php

namespace Domktorymysli\Grenton\Encoder;

use Domktorymysli\Grenton\Encoder\Model\CipherKey;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;

/**
 * Class Decoder
 * @package Domktorymysli\Grenton\Encoder
 */
final class Decoder
{

    private static $OPENSSL_CIPHER_NAME = "aes-128-cbc";

    /**
     * @var CipherKey
     */
    private $cipherKey;

    /**
     * @param CipherKey $cipherKey
     */
    public function __construct(CipherKey $cipherKey)
    {
        $this->cipherKey = $cipherKey;
    }

    /**
     * @param $msg
     *
     * @return MessageDecoded
     */
    public function decode(MessageEncoded $msg)
    {
       $decryptedData = openssl_decrypt(
           $msg->getMsg(),
           static::$OPENSSL_CIPHER_NAME,
           $this->cipherKey->getKey(),
           OPENSSL_RAW_DATA,
           $this->cipherKey->getIv()
       );

       $messageDecoded = new MessageDecoded($decryptedData);

       return $messageDecoded;
    }
}
