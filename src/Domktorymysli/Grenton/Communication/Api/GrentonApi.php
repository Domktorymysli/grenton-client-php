<?php

namespace Domktorymysli\Grenton\Communication\Api;

use Domktorymysli\Grenton\Command\CluCommand;
use Domktorymysli\Grenton\Command\CluCommandResponse;
use Domktorymysli\Grenton\Encoder\Api\Encoder;
use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;
use Domktorymysli\Grenton\Encoder\Model\MessageEncoded;
use Domktorymysli\Grenton\Model\Clu;
use Psr\Log\LoggerInterface;

/**
 * Class GrentonApi
 * @package Domktorymysli\Grenton\Communication\Api
 */
final class GrentonApi implements Api
{
    /**
     * @var Clu
     */
    private $clu;

    /**
     * @var Encoder
     */
    private $encoder;

    /**
     * @var Socket
     */
    private $socket;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * GrentonApi constructor.
     * @param Clu $clu
     * @param Encoder $encoder
     * @param Socket $socket
     * @param LoggerInterface $logger
     */
    public function __construct(Clu $clu, Encoder $encoder, Socket $socket, LoggerInterface $logger)
    {
        $this->clu = $clu;
        $this->encoder = $encoder;
        $this->logger = $logger;
        $this->socket = $socket;
    }

    /**
     * @inheritdoc
     */
    public function send(CluCommand $command)
    {
        $messageEncoded = $this->encoder->encode(new MessageDecoded($command->getCommand()));
        $message = $messageEncoded->getMsg();

        $this->logger->info("Sending command: " . $command->getCommand() . " to " . $this->clu->getIp());
        $startTime = round(microtime(true) * 1000);
        $result = $this->socket->send($this->clu, $message);
        $estimatedTime = round(microtime(true) * 1000) - $startTime;
        $messageDecoded = $this->encoder->decode(new MessageEncoded($result, 2048));
        $commandResponse = new CluCommandResponse($messageDecoded);
        $this->logger->info("Clu response: " . $commandResponse->getMessageDecoded()->__toString() . ", in " . $estimatedTime . " ms");

        return $commandResponse;
    }
}
