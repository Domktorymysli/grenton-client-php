<?php

namespace Domktorymysli\Grenton\Cli;

use Domktorymysli\Grenton\Communication\Api\Api;
use Domktorymysli\Grenton\Communication\Api\GrentonApi;
use Domktorymysli\Grenton\Communication\Api\GrentonSocket;
use Domktorymysli\Grenton\Encoder\Api\EncoderGrenton;
use Domktorymysli\Grenton\Model\Clu;
use Domktorymysli\Grenton\Tools\PropertiesLoader;
use Psr\Log\LoggerInterface;

/**
 * Class AppContainer
 * @package Domktorymysli\Grenton\Cli
 */
final class AppContainer
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PropertiesLoader
     */
    private $propertiesLoader;

    /**
     * AppData constructor.
     * @param PropertiesLoader $propertiesLoader
     * @param LoggerInterface $logger
     * @internal param Api $api
     */
    public function __construct(PropertiesLoader $propertiesLoader, LoggerInterface $logger)
    {
        $this->propertiesLoader = $propertiesLoader;
        $this->logger = $logger;
    }

    /**
     * @param string $configFilename
     * @return Api
     */
    public function getApi($configFilename)
    {
        $properties = $this->propertiesLoader->loadProperties($configFilename);
        $clu = new Clu($properties->getCluIp(), $properties->getCluPort());
        $encoder = new EncoderGrenton($properties->getCluKey(), $properties->getCluIv());
        $socket = new GrentonSocket();
        $api = new GrentonApi($clu, $encoder, $socket, $this->logger);

        return $api;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

}
