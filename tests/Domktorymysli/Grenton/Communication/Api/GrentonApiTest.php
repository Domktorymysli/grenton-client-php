<?php
namespace Domktorymysli\Grenton\Communication\Api;

use Domktorymysli\Grenton\Command\CluRawCommand;
use Domktorymysli\Grenton\Encoder\Api\EncoderGrenton;
use Domktorymysli\Grenton\Model\Clu;
use Domktorymysli\Grenton\Tools\PropertiesLoaderImpl;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

final class GrentonApiTest extends TestCase
{

    public function testSend()
    {
        $propertiesLoader = new PropertiesLoaderImpl();
        $properties = $propertiesLoader->loadProperties(__DIR__ . "/../../../../resources/properties-dist.xml");

        $encoder = new EncoderGrenton($properties->getCluKey(), $properties->getCluIv());
        $clu = new Clu($properties->getCluIp(), $properties->getCluPort());

        $grentonSocket = $this->createMock(Socket::class);
        $grentonSocket->method('send')
            ->willReturn(base64_decode('2JG7AKU6mhnBaL3x8CPlDkldsLCcZ5HJHqxCPXhgG4EiZCPSt6iiNWPc4fzXGiG1QRLXCkhhPKFqu+hbpmDxfA=='));

        $grentonApi = new GrentonApi($clu, $encoder, $grentonSocket, new Logger('test'));
        $command = new CluRawCommand("req:192.168.1.104:001524:test(nil)");

        $response = $grentonApi->send($command);

        $this->assertEquals("resp:192.168.2.200:00001524:{\"t1\":22.400000,\"t2\":22.299999}", $response->getCommand());
        $this->assertEquals("{\"t1\":22.400000,\"t2\":22.299999}", $response->getBody());
    }
}

