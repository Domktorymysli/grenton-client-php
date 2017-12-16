<?php
namespace Domktorymysli\Grenton\Tools;

use Domktorymysli\Grenton\Expection\PropertiesException;
use Domktorymysli\Grenton\Model\Properties;

/**
 * Class PropertiesLoaderImpl
 * @package Domktorymysli\Grenton\Tools
 */
final class PropertiesLoaderImpl implements PropertiesLoader
{

    /**
     * @param string $filename
     * @return Properties
     *
     * @throws PropertiesException
     */
    public function loadProperties($filename)
    {
        if (!file_exists($filename)) {
            throw new PropertiesException("Failed to open: \"{$filename}\"!");
        }

        $xml = simplexml_load_file($filename);

        $properties = new Properties();

        $properties->setCluKey($xml->cluKey);
        $properties->setCluIv($xml->cluIv);
        $properties->setCluIp($xml->cluIp);
        $properties->setCluPort((int) $xml->cluPort);

        return $properties;
    }
}