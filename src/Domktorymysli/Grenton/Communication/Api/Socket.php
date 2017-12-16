<?php

namespace Domktorymysli\Grenton\Communication\Api;

use Domktorymysli\Grenton\Model\Clu;

/**
 * Interface Socket
 * @package Domktorymysli\Grenton\Communication\Api
 */
interface Socket
{

    /**
     * @param Clu $clu
     * @param string $message
     *
     * @return string
     */
    public function send(Clu $clu, $message);

}
