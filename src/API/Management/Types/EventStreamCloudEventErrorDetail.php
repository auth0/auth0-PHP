<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Error details.
 */
class EventStreamCloudEventErrorDetail extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamCloudEventErrorCodeEnum> $code
     */
    #[JsonProperty('code')]
    private string $code;

    /**
     * @var string $message Human-readable error message.
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @var ?string $offset The cursor at the time of the error (when available). Can be used to resume from this position.
     */
    #[JsonProperty('offset')]
    private ?string $offset;

    /**
     * @param array{
     *   code: value-of<EventStreamCloudEventErrorCodeEnum>,
     *   message: string,
     *   offset?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->message = $values['message'];
        $this->offset = $values['offset'] ?? null;
    }

    /**
     * @return value-of<EventStreamCloudEventErrorCodeEnum>
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param value-of<EventStreamCloudEventErrorCodeEnum> $value
     */
    public function setCode(string $value): self
    {
        $this->code = $value;
        $this->_setField('code');
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
     * @return ?string
     */
    public function getOffset(): ?string
    {
        return $this->offset;
    }

    /**
     * @param ?string $value
     */
    public function setOffset(?string $value = null): self
    {
        $this->offset = $value;
        $this->_setField('offset');
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
