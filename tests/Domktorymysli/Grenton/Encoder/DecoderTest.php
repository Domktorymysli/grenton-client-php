<?php

namespace Domktorymysli\Grenton\Encoder;

use Domktorymysli\Grenton\Encoder\Model\CipherKey;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;
use PHPUnit\Framework\TestCase;

/**
 * Class DecoderTest
 * @package Domktorymysli\Grenton\Encoder
 */
final class DecoderTest extends TestCase
{

    public function testDecode()
    {
        $cipherKey = CipherKey::createFromString("KY1Ajg+pDBQcP2cHnIFNRQ==", "/gV+nXMOUlBbuc3uhkk/eA==");
        $decoder = new Decoder($cipherKey);

        /*
         0000   10 63 61 85 29 5a 6d bd 45 67 0d 1e 05 db 7d 45  .ca.)Zm.Eg....}E
         0010   32 44 22 c5 54 8e 8f c2 01 4e 4d a0 13 ba 76 26  2D".T....NM...v&
         0020   39 0d b9 11 81 f9 5e 73 a2 43 0e 44 6d 97 d1 cc  9.....^s.C.Dm...
         0030   5d 6d 6e 53 5f 96 a5 98 e0 0a 0e 99 f0 e5 12 48  ]mnS_..........H
         */
        $s = "10636185295a6dbd45670d1e05db7d45324422c5548e8fc2014e4da013ba7626390db91181f95e73a2430e446d97d1cc5d6d6e535f96a598e00a0e99f0e51248";

        $msg = MessageEncoded::createFromString($s);
        $messageDecoded = $decoder->decode($msg);

        $this->assertEquals("req:192.168.1.104:00be11:DOUT_8565:execute(2, 0)\r\n", $messageDecoded->__toString());
    }

    public function testDecode2()
    {
        $cipherKey = CipherKey::createFromString("KY1Ajg+pDBQcP2cHnIFNRQ==", "/gV+nXMOUlBbuc3uhkk/eA==");
        $decoder = new Decoder($cipherKey);

        /*
         0000   d8 91 bb 00 a5 3a 9a 19 c1 68 bd f1 f0 23 e5 0e  .....:...h...#..
         0010   4a 04 0f 5f 25 5b 9d ed 27 64 33 48 9d 67 a2 78  J.._%[..'d3H.g.x

         :h#8cB}gY*@:>
         */
        $s = "d891bb00a53a9a19c168bdf1f023e50e4a040f5f255b9ded276433489d67a278";

        $msg = MessageEncoded::createFromString($s);
        $messageDecoded = $decoder->decode($msg);

        $this->assertEquals("resp:192.168.2.200:0000be11:nil", $messageDecoded->__toString());
    }

    public function testDecode3()
    {
        $cipherKey = CipherKey::createFromString("KY1Ajg+pDBQcP2cHnIFNRQ==", "/gV+nXMOUlBbuc3uhkk/eA==");
        $decoder = new Decoder($cipherKey);

        /*
        0000   d8 91 bb 00 a5 3a 9a 19 c1 68 bd f1 f0 23 e5 0e  .....:...h...#..
        0010   4e df e1 d3 97 35 0f 3b 2c b6 43 e6 b2 43 d8 df  N....5.;,.C..C..
        0020   0b d5 93 1b 48 76 a4 c9 26 ca c5 fa 5e f7 d0 13  ....Hv..&...^...
        0030   81 98 aa c3 e7 b7 20 a3 12 30 e1 8d 58 ff b8 31  ...... ..0..X..1
        0040   3d c8 0d ed 3a 12 3e 0e f1 b2 0a 9e f7 57 0b da  =...:.>......W..

        :h#N5;,CCHv&^ 0X1=
        :>
        W
        */
        $s = "d891bb00a53a9a19c168bdf1f023e50e4edfe1d397350f3b2cb643e6b243d8df0bd5931b4876a4c926cac5fa5ef7d0138198aac3e7b720a31230e18d58ffb8313dc80ded3a123e0ef1b20a9ef7570bda";

        $msg = MessageEncoded::createFromString($s);
        $messageDecoded = $decoder->decode($msg);

        $this->assertEquals("resp:192.168.2.200:00009fe5:clientReport:210:{0,1,0,0,1,1,0,0}\n\r", $messageDecoded->__toString());
    }
}
