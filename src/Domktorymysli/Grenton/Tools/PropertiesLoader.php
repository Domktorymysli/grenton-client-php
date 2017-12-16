<?php

namespace Domktorymysli\Grenton\Tools;

use Domktorymysli\Grenton\Expection\PropertiesException;
use Domktorymysli\Grenton\Model\Properties;

/**
 * Interface PropertiesLoader
 * @package Domktorymysli\Grenton\Tools
 */
interface PropertiesLoader
{

    /**
     * @param String $filename
     * @return Properties
     *
     * @throws PropertiesException
     */
    public function loadProperties($filename);

}
