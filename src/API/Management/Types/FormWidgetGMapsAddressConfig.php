<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormWidgetGMapsAddressConfig extends JsonSerializableType
{
    /**
     * @var string $apiKey
     */
    #[JsonProperty('api_key')]
    private string $apiKey;

    /**
     * @var ?string $serverKey
     */
    #[JsonProperty('server_key')]
    private ?string $serverKey;

    /**
     * @param array{
     *   apiKey: string,
     *   serverKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->apiKey = $values['apiKey'];
        $this->serverKey = $values['serverKey'] ?? null;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $value
     */
    public function setApiKey(string $value): self
    {
        $this->apiKey = $value;
        $this->_setField('apiKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getServerKey(): ?string
    {
        return $this->serverKey;
    }

    /**
     * @param ?string $value
     */
    public function setServerKey(?string $value = null): self
    {
        $this->serverKey = $value;
        $this->_setField('serverKey');
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
