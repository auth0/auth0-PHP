<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Google Firebase addon configuration.
 */
class ClientAddonFirebase extends JsonSerializableType
{
    /**
     * @var ?string $secret Google Firebase Secret. (SDK 2 only).
     */
    #[JsonProperty('secret')]
    private ?string $secret;

    /**
     * @var ?string $privateKeyId Optional ID of the private key to obtain kid header in the issued token (SDK v3+ tokens only).
     */
    #[JsonProperty('private_key_id')]
    private ?string $privateKeyId;

    /**
     * @var ?string $privateKey Private Key for signing the token (SDK v3+ tokens only).
     */
    #[JsonProperty('private_key')]
    private ?string $privateKey;

    /**
     * @var ?string $clientEmail ID of the Service Account you have created (shown as `client_email` in the generated JSON file, SDK v3+ tokens only).
     */
    #[JsonProperty('client_email')]
    private ?string $clientEmail;

    /**
     * @var ?int $lifetimeInSeconds Optional expiration in seconds for the generated token. Defaults to 3600 seconds (SDK v3+ tokens only).
     */
    #[JsonProperty('lifetime_in_seconds')]
    private ?int $lifetimeInSeconds;

    /**
     * @param array{
     *   secret?: ?string,
     *   privateKeyId?: ?string,
     *   privateKey?: ?string,
     *   clientEmail?: ?string,
     *   lifetimeInSeconds?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->secret = $values['secret'] ?? null;
        $this->privateKeyId = $values['privateKeyId'] ?? null;
        $this->privateKey = $values['privateKey'] ?? null;
        $this->clientEmail = $values['clientEmail'] ?? null;
        $this->lifetimeInSeconds = $values['lifetimeInSeconds'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSecret(): ?string
    {
        return $this->secret;
    }

    /**
     * @param ?string $value
     */
    public function setSecret(?string $value = null): self
    {
        $this->secret = $value;
        $this->_setField('secret');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrivateKeyId(): ?string
    {
        return $this->privateKeyId;
    }

    /**
     * @param ?string $value
     */
    public function setPrivateKeyId(?string $value = null): self
    {
        $this->privateKeyId = $value;
        $this->_setField('privateKeyId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrivateKey(): ?string
    {
        return $this->privateKey;
    }

    /**
     * @param ?string $value
     */
    public function setPrivateKey(?string $value = null): self
    {
        $this->privateKey = $value;
        $this->_setField('privateKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientEmail(): ?string
    {
        return $this->clientEmail;
    }

    /**
     * @param ?string $value
     */
    public function setClientEmail(?string $value = null): self
    {
        $this->clientEmail = $value;
        $this->_setField('clientEmail');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLifetimeInSeconds(): ?int
    {
        return $this->lifetimeInSeconds;
    }

    /**
     * @param ?int $value
     */
    public function setLifetimeInSeconds(?int $value = null): self
    {
        $this->lifetimeInSeconds = $value;
        $this->_setField('lifetimeInSeconds');
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
