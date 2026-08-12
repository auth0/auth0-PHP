<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionWhatsappSendMessageParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $senderId
     */
    #[JsonProperty('sender_id')]
    private string $senderId;

    /**
     * @var string $recipientNumber
     */
    #[JsonProperty('recipient_number')]
    private string $recipientNumber;

    /**
     * @var value-of<FlowActionWhatsappSendMessageParamsType> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var (
     *    array<string, mixed>
     *   |string
     * ) $payload
     */
    #[JsonProperty('payload'), Union(['string' => 'mixed'], 'string')]
    private array|string $payload;

    /**
     * @param array{
     *   connectionId: string,
     *   senderId: string,
     *   recipientNumber: string,
     *   type: value-of<FlowActionWhatsappSendMessageParamsType>,
     *   payload: (
     *    array<string, mixed>
     *   |string
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->senderId = $values['senderId'];
        $this->recipientNumber = $values['recipientNumber'];
        $this->type = $values['type'];
        $this->payload = $values['payload'];
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
    public function getSenderId(): string
    {
        return $this->senderId;
    }

    /**
     * @param string $value
     */
    public function setSenderId(string $value): self
    {
        $this->senderId = $value;
        $this->_setField('senderId');
        return $this;
    }

    /**
     * @return string
     */
    public function getRecipientNumber(): string
    {
        return $this->recipientNumber;
    }

    /**
     * @param string $value
     */
    public function setRecipientNumber(string $value): self
    {
        $this->recipientNumber = $value;
        $this->_setField('recipientNumber');
        return $this;
    }

    /**
     * @return value-of<FlowActionWhatsappSendMessageParamsType>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowActionWhatsappSendMessageParamsType> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return (
     *    array<string, mixed>
     *   |string
     * )
     */
    public function getPayload(): array|string
    {
        return $this->payload;
    }

    /**
     * @param (
     *    array<string, mixed>
     *   |string
     * ) $value
     */
    public function setPayload(array|string $value): self
    {
        $this->payload = $value;
        $this->_setField('payload');
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
