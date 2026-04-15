<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Custom header authorization for HTTP requests.
 */
class EventStreamWebhookCustomHeaderAuth extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamWebhookCustomHeaderAuthMethodEnum> $method
     */
    #[JsonProperty('method')]
    private string $method;

    /**
     * @var string $headerKey HTTP header name.
     */
    #[JsonProperty('header_key')]
    private string $headerKey;

    /**
     * @param array{
     *   method: value-of<EventStreamWebhookCustomHeaderAuthMethodEnum>,
     *   headerKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->headerKey = $values['headerKey'];
    }

    /**
     * @return value-of<EventStreamWebhookCustomHeaderAuthMethodEnum>
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param value-of<EventStreamWebhookCustomHeaderAuthMethodEnum> $value
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
    public function getHeaderKey(): string
    {
        return $this->headerKey;
    }

    /**
     * @param string $value
     */
    public function setHeaderKey(string $value): self
    {
        $this->headerKey = $value;
        $this->_setField('headerKey');
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
