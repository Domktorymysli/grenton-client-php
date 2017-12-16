<?php

namespace Domktorymysli\Grenton\Communication\Api;

use Domktorymysli\Grenton\Expection\GrentonApiException;
use Domktorymysli\Grenton\Model\Clu;

/**
 * Class GrentonSocket
 * @package Domktorymysli\Grenton\Communication\Api
 */
final class GrentonSocket implements Socket
{
    /**
     * @var int
     */
    private $domain;

    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $protocol;

    /**
     * GrentonSocket constructor.
     * @param int $domain
     * @param int $type
     * @param int $protocol
     */
    public function __construct($domain = AF_INET, $type = SOCK_DGRAM, $protocol = SOL_UDP)
    {
        $this->domain = $domain;
        $this->type = $type;
        $this->protocol = $protocol;
    }

    /**
     * @inheritdoc
     */
    public function send(Clu $clu, $message)
    {
        $socket = socket_create($this->domain, $this->type, $this->protocol);
        $timeout = array('sec' => 1, 'usec' => 1000);
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, $timeout);

        if (!socket_connect($socket, $clu->getIp(), (int)$clu->getPort())) {
            $lastSocketError = socket_last_error($socket);
            throw new GrentonApiException($lastSocketError);
        }

        socket_send($socket, $message, strlen($message), 0);
        $result = @socket_read($socket, 2048);
        $lastSocketError = socket_last_error($socket);
        socket_close($socket);

        if ($result === false) {
            throw new GrentonApiException("Connection reset by peer [{$lastSocketError}]");
        }

        return $result;
    }
}
