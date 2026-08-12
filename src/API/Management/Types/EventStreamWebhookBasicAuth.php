<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Basic Authorization for HTTP requests (e.g., 'Basic credentials').
 */
class EventStreamWebhookBasicAuth extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamWebhookBasicAuthMethodEnum> $method
     */
    #[JsonProperty('method')]
    private string $method;

    /**
     * @var string $username Username
     */
    #[JsonProperty('username')]
    private string $username;

    /**
     * @param array{
     *   method: value-of<EventStreamWebhookBasicAuthMethodEnum>,
     *   username: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->username = $values['username'];
    }

    /**
     * @return value-of<EventStreamWebhookBasicAuthMethodEnum>
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param value-of<EventStreamWebhookBasicAuthMethodEnum> $value
     */
    public function setMethod(string $value): self
    {
        $this->method = $value;
        $this->_setField('method');
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $value
     */
    public function setUsername(string $value): self
    {
        $this->username = $value;
        $this->_setField('username');
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
