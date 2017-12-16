<?php

namespace Domktorymysli\Grenton\Command;

use PHPUnit\Framework\TestCase;

final class CluRawCommandTest extends TestCase
{
    public function testGetCommand()
    {
        $cluRawCommand = new CluRawCommand("test");
        $this->assertEquals("test", $cluRawCommand->getCommand());
    }
}
