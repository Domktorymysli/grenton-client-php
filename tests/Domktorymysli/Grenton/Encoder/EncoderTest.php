<?php

namespace Domktorymysli\Grenton\Encoder;

use Domktorymysli\Grenton\Encoder\Model\CipherKey;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use PHPUnit\Framework\TestCase;

final class EncoderTest extends TestCase
{

    public function testEncode()
    {

        $cipherKey = CipherKey::createFromString("KY1Ajg+pDBQcP2cHnIFNRQ==", "/gV+nXMOUlBbuc3uhkk/eA==");
        $encoder = new Encoder($cipherKey);

        $decoder = new Decoder($cipherKey);

        $messageDecodedSource = new MessageDecoded("Grenton");
        $messageEncoded = $encoder->encode($messageDecodedSource);
        $messageDecodedResult = $decoder->decode($messageEncoded);

        $this->assertEquals($messageDecodedSource->__toString(), $messageDecodedResult->__toString());
    }

}
