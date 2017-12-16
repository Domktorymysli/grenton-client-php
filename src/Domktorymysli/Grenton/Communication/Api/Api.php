<?php

namespace Domktorymysli\Grenton\Communication\Api;

use Domktorymysli\Grenton\Command\CluCommand;
use Domktorymysli\Grenton\Command\CluCommandResponse;

/**
 * Interface Api
 * @package Domktorymysli\Grenton\Communication\Api
 */
interface Api
{

    /**
     * @param CluCommand $command
     * @return CluCommandResponse
     */
    public function send(CluCommand $command);

}
