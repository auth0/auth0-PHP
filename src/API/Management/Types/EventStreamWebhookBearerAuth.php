<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Bearer Authorization for HTTP requests (e.g., 'Bearer token').
 */
class EventStreamWebhookBearerAuth extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamWebhookBearerAuthMethodEnum> $method
     */
    #[JsonProperty('method')]
    private string $method;

    /**
     * @param array{
     *   method: value-of<EventStreamWebhookBearerAuthMethodEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
    }

    /**
     * @return value-of<EventStreamWebhookBearerAuthMethodEnum>
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param value-of<EventStreamWebhookBearerAuthMethodEnum> $value
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
