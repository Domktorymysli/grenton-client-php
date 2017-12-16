<?php

namespace Domktorymysli\Grenton\Command;

use PHPUnit\Framework\TestCase;

final class CluFunctionCommandTest extends TestCase
{

    public function testGetCommand()
    {
        $ip = "127.0.0.1";
        $cluFunctionCommand = new CluFunctionCommand($ip, "test", ["arg1", "arg2"]);
        $this->assertRegExp("#req:127\.0\.0\.1:[a-f0-9]{6}:test\(arg1,arg2\)#", $cluFunctionCommand->getCommand());

    }

    public function testGetCommandWithStringParams()
    {
        $ip = "127.0.0.1";
        $cluFunctionCommand = new CluFunctionCommand($ip, "test", ["\'arg1\'", "\'arg2\'"]);
        $this->assertRegExp("#req:127\\.0\\.0\\.1:[a-f0-9]{6}:test\\(\\\'arg1\\\',\\\'arg2\\\'\\)#", $cluFunctionCommand->getCommand());
    }

    public function testGetCommandWithoutParams()
    {
        $ip = "127.0.0.1";
        $cluFunctionCommand = new CluFunctionCommand($ip, "test", []);
        $this->assertRegExp("#req:127\\.0\\.0\\.1:[a-f0-9]{6}:test\\(nil\\)#", $cluFunctionCommand->getCommand());
    }
}
