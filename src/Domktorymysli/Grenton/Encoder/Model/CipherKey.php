<?php

namespace Domktorymysli\Grenton\Encoder\Model;;

/**
 * Class CipherKey
 * @package Model
 */
final class CipherKey
{

    /**
     * @var type
     */
    private $key;

    /**
     * @var type
     */
    private $iv;

    /**
     * CipherKey constructor.
     *
     * @param $key
     * @param $iv
     */
    private function __construct($key, $iv)
    {
        $this->key = $key;
        $this->iv = $iv;
    }

    /**
     * @param string $key secret key
     * @param string $iv  initialization vector(IV)
     *
     * @return CipherKey
     */
    public static function createFromString($key, $iv)
    {
        return new CipherKey(base64_decode($key), base64_decode($iv));
    }

    /**
     * @return type
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return type
     */
    public function getIv()
    {
        return $this->iv;
    }

}
