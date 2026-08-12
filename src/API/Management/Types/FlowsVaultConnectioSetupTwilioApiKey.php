<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupTwilioApiKey extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeApiKeyEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $accountId
     */
    #[JsonProperty('account_id')]
    private string $accountId;

    /**
     * @var string $apiKey
     */
    #[JsonProperty('api_key')]
    private string $apiKey;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeApiKeyEnum>,
     *   accountId: string,
     *   apiKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->accountId = $values['accountId'];
        $this->apiKey = $values['apiKey'];
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
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * @param string $value
     */
    public function setAccountId(string $value): self
    {
        $this->accountId = $value;
        $this->_setField('accountId');
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
