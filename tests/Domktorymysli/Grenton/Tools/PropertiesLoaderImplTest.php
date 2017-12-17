<?php

namespace Domktorymysli\Grenton\Tools;

use Domktorymysli\Grenton\Expection\PropertiesException;
use PHPUnit\Framework\TestCase;

final class PropertiesLoaderImplTest extends TestCase
{

    public function testLoadProperties()
    {

        $propertiesLoader = new PropertiesLoaderImpl();
        $properties = $propertiesLoader->loadProperties(__DIR__ . "/../../../resources/properties-dist.xml");
        $this->assertEquals("192.168.2.200", $properties->getCluIp());
        $this->assertEquals(1234, (int)$properties->getCluPort());
        $this->assertEquals("KY1Ajg+pDBQcP2cHnIFNRQ==", $properties->getCluKey());
        $this->assertEquals("/gV+nXMOUlBbuc3uhkk/eA==", $properties->getCluIv());

    }

    public function testLoadPropertiesForNotExistingFile()
    {

        try {
            $propertiesLoader = new PropertiesLoaderImpl();
            $propertiesLoader->loadProperties("nofile.xml");
            $this->assertFalse(false,"expected exception was not occurred.");
        } catch (PropertiesException $e) {
            // ok
            $this->assertTrue(true);
        }

    }

}
