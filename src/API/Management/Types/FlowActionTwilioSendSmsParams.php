<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionTwilioSendSmsParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $from
     */
    #[JsonProperty('from')]
    private string $from;

    /**
     * @var string $to
     */
    #[JsonProperty('to')]
    private string $to;

    /**
     * @var string $message
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @param array{
     *   connectionId: string,
     *   from: string,
     *   to: string,
     *   message: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->from = $values['from'];
        $this->to = $values['to'];
        $this->message = $values['message'];
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
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $value
     */
    public function setFrom(string $value): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $value
     */
    public function setTo(string $value): self
    {
        $this->to = $value;
        $this->_setField('to');
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $value
     */
    public function setMessage(string $value): self
    {
        $this->message = $value;
        $this->_setField('message');
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
