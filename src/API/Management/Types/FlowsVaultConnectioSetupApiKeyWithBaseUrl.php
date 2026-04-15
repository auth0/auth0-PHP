<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupApiKeyWithBaseUrl extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeApiKeyEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $apiKey
     */
    #[JsonProperty('api_key')]
    private string $apiKey;

    /**
     * @var string $baseUrl
     */
    #[JsonProperty('base_url')]
    private string $baseUrl;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeApiKeyEnum>,
     *   apiKey: string,
     *   baseUrl: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->apiKey = $values['apiKey'];
        $this->baseUrl = $values['baseUrl'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeApiKeyEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeApiKeyEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
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
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $value
     */
    public function setBaseUrl(string $value): self
    {
        $this->baseUrl = $value;
        $this->_setField('baseUrl');
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
