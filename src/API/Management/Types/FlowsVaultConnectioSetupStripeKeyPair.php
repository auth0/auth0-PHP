<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupStripeKeyPair extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeKeyPairEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $privateKey
     */
    #[JsonProperty('private_key')]
    private string $privateKey;

    /**
     * @var string $publicKey
     */
    #[JsonProperty('public_key')]
    private string $publicKey;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeKeyPairEnum>,
     *   privateKey: string,
     *   publicKey: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->privateKey = $values['privateKey'];
        $this->publicKey = $values['publicKey'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeKeyPairEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeKeyPairEnum> $value
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
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * @param string $value
     */
    public function setPrivateKey(string $value): self
    {
        $this->privateKey = $value;
        $this->_setField('privateKey');
        return $this;
    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @param string $value
     */
    public function setPublicKey(string $value): self
    {
        $this->publicKey = $value;
        $this->_setField('publicKey');
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
