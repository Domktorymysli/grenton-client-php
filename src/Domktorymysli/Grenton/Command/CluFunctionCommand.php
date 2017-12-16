<?php

namespace Domktorymysli\Grenton\Command;

/**
 * Class CluFunctionCommand
 * @package Domktorymysli\Grenton\Command
 */
final class CluFunctionCommand extends CluCommandBase implements CluCommand
{

    /**
     * CluFunctionCommand constructor.
     * @param $ip
     * @param $functionName
     * @param array $args
     */
    public function __construct($ip, $functionName, array $args)
    {
        $sessionId = $this->generateRandomSessionId();
        $arguments = "nil";

        if (count($args) > 0) {
            $arguments = implode(",", $args);
        }

        $this->command = "req:" . $ip . ":" . $sessionId . ":" . $functionName . "(" . $arguments . ")";
    }

    private function generateRandomSessionId()
    {
        $randomSessionId = substr(bin2hex(pack("H*", sprintf("%08X", rand(0, 65534)))), 2, 6);

        return $randomSessionId;
    }

}