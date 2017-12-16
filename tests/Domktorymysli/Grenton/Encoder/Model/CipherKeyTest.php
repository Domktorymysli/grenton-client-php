<?php
namespace Domktorymysli\Grenton\Encoder\Model;

use PHPUnit\Framework\TestCase;

final class CipherKeyTest extends TestCase
{

    public function testCreateCipherKey()
    {
        $cipherKey = CipherKey::createFromString("KY1Ajg+pDBQcP2cHnIFNRQ==", "/gV+nXMOUlBbuc3uhkk/eA==");

        $this->assertEquals("KY1Ajg+pDBQcP2cHnIFNRQ==", base64_encode($cipherKey->getKey()));
        $this->assertEquals("/gV+nXMOUlBbuc3uhkk/eA==", base64_encode($cipherKey->getIv()));
    }

}
