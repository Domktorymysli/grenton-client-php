<?php

namespace Domktorymysli\Grenton\Command;

use Domktorymysli\Grenton\Encoder\Model\MessageDecoded;

/**
 * Class CluCommandResponse
 * @package Domktorymysli\Grenton\Command
 */
final class CluCommandResponse extends CluCommandBase implements CluCommand
{

    /**
     * @var MessageDecoded
     */
    private $messageDecoded;

    /**
     * CluCommandResponse constructor.
     * @param MessageDecoded $messageDecoded
     */
    public function __construct(MessageDecoded $messageDecoded)
    {
        $this->messageDecoded = $messageDecoded;

        if (preg_match_all(CluCommand::PATTERN, $messageDecoded->__toString(), $matches)) {
            $this->type = $matches[1][0];
            $this->ip = $matches[2][0];
            $this->sessionId = $matches[3][0];
            $this->body = $matches[4][0];
        }
    }

    /**
     * @inheritdoc
     */
    public function getCommand()
    {
        return $this->messageDecoded->__toString();
    }

    /**
     * @return MessageDecoded
     */
    public function getMessageDecoded()
    {
        return $this->messageDecoded;
    }

}
