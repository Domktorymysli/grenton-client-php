<?php

namespace Domktorymysli\Grenton\Command;

use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use PHPUnit\Framework\TestCase;

class CluCommandResponseTest extends TestCase
{

    public function testGetMessageDecoded()
    {
        $messageDecoded = new MessageDecoded("req:192.168.1.104:001524:test(banan,assasa)");
        $cluCommandResponse = new CluCommandResponse($messageDecoded);
        $this->assertEquals("req:192.168.1.104:001524:test(banan,assasa)", $cluCommandResponse->getMessageDecoded()->__toString());
    }

    public function testGetData()
    {
        $messageDecoded = new MessageDecoded("req:192.168.1.104:001524:test('banan','assasa')");
        $cluCommandResponse = new CluCommandResponse($messageDecoded);

        $this->assertEquals("test('banan','assasa')", $cluCommandResponse->getBody());
        $this->assertEquals("req", $cluCommandResponse->getType());
        $this->assertEquals("192.168.1.104", $cluCommandResponse->getIp());
        $this->assertEquals("001524", $cluCommandResponse->getSessionId());
    }

    public function testStrangeResponse()
    {
        $messageDecoded = new MessageDecoded("some strange string");
        $cluCommandResponse = new CluCommandResponse($messageDecoded);

        $this->assertEquals("", $cluCommandResponse->getBody());
        $this->assertEquals("error", $cluCommandResponse->getType());
    }

    public function testJsonResponse()
    {
        $messageDecoded = new MessageDecoded("resp:192.168.2.200:00008d39:{\"t1\":23.000000,\"t2\":1.000000}");
        $cluCommandResponse = new CluCommandResponse($messageDecoded);

        $this->assertEquals("{\"t1\":23.000000,\"t2\":1.000000}", $cluCommandResponse->getBody());
        $this->assertEquals("resp", $cluCommandResponse->getType());
        $this->assertEquals("192.168.2.200", $cluCommandResponse->getIp());
        $this->assertEquals("00008d39", $cluCommandResponse->getSessionId());
    }

    public function testErrorResponse()
    {
        $messageDecoded = new MessageDecoded("resp:192.168.2.200:0000c426:LUA ERROR: a:\\./user.lua:19.000000: attempt to concatenate global 'temperatureSensorTwo' (a function value)");
        $cluCommandResponse = new CluCommandResponse($messageDecoded);

        $this->assertEquals("LUA ERROR: a:\\./user.lua:19.000000: attempt to concatenate global 'temperatureSensorTwo' (a function value)", $cluCommandResponse->getBody());
        $this->assertEquals("resp", $cluCommandResponse->getType());
        $this->assertEquals("192.168.2.200", $cluCommandResponse->getIp());
        $this->assertEquals("0000c426", $cluCommandResponse->getSessionId());
    }

}
