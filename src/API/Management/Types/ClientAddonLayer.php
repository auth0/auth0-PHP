<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Layer addon configuration.
 */
class ClientAddonLayer extends JsonSerializableType
{
    /**
     * @var string $providerId Provider ID of your Layer account
     */
    #[JsonProperty('providerId')]
    private string $providerId;

    /**
     * @var string $keyId Authentication Key identifier used to sign the Layer token.
     */
    #[JsonProperty('keyId')]
    private string $keyId;

    /**
     * @var string $privateKey Private key for signing the Layer token.
     */
    #[JsonProperty('privateKey')]
    private string $privateKey;

    /**
     * @var ?string $principal Name of the property used as the unique user id in Layer. If not specified `user_id` is used.
     */
    #[JsonProperty('principal')]
    private ?string $principal;

    /**
     * @var ?int $expiration Optional expiration in minutes for the generated token. Defaults to 5 minutes.
     */
    #[JsonProperty('expiration')]
    private ?int $expiration;

    /**
     * @param array{
     *   providerId: string,
     *   keyId: string,
     *   privateKey: string,
     *   principal?: ?string,
     *   expiration?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->providerId = $values['providerId'];
        $this->keyId = $values['keyId'];
        $this->privateKey = $values['privateKey'];
        $this->principal = $values['principal'] ?? null;
        $this->expiration = $values['expiration'] ?? null;
    }

    /**
     * @return string
     */
    public function getProviderId(): string
    {
        return $this->providerId;
    }

    /**
     * @param string $value
     */
    public function setProviderId(string $value): self
    {
        $this->providerId = $value;
        $this->_setField('providerId');
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyId(): string
    {
        return $this->keyId;
    }

    /**
     * @param string $value
     */
    public function setKeyId(string $value): self
    {
        $this->keyId = $value;
        $this->_setField('keyId');
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
     * @return ?string
     */
    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    /**
     * @param ?string $value
     */
    public function setPrincipal(?string $value = null): self
    {
        $this->principal = $value;
        $this->_setField('principal');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getExpiration(): ?int
    {
        return $this->expiration;
    }

    /**
     * @param ?int $value
     */
    public function setExpiration(?int $value = null): self
    {
        $this->expiration = $value;
        $this->_setField('expiration');
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
