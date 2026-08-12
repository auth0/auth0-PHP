<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionTelegramSendMessageParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $chatId
     */
    #[JsonProperty('chat_id')]
    private string $chatId;

    /**
     * @var string $text
     */
    #[JsonProperty('text')]
    private string $text;

    /**
     * @param array{
     *   connectionId: string,
     *   chatId: string,
     *   text: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->chatId = $values['chatId'];
        $this->text = $values['text'];
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getChatId(): string
    {
        return $this->chatId;
    }

    /**
     * @param string $value
     */
    public function setChatId(string $value): self
    {
        $this->chatId = $value;
        $this->_setField('chatId');
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $value
     */
    public function setText(string $value): self
    {
        $this->text = $value;
        $this->_setField('text');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
