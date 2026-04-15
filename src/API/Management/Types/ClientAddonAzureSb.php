<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Azure Storage Bus addon configuration.
 */
class ClientAddonAzureSb extends JsonSerializableType
{
    /**
     * @var ?string $namespace Your Azure Service Bus namespace. Usually the first segment of your Service Bus URL (e.g. `https://acme-org.servicebus.windows.net` would be `acme-org`).
     */
    #[JsonProperty('namespace')]
    private ?string $namespace;

    /**
     * @var ?string $sasKeyName Your shared access policy name defined in your Service Bus entity.
     */
    #[JsonProperty('sasKeyName')]
    private ?string $sasKeyName;

    /**
     * @var ?string $sasKey Primary Key associated with your shared access policy.
     */
    #[JsonProperty('sasKey')]
    private ?string $sasKey;

    /**
     * @var ?string $entityPath Entity you want to request a token for. e.g. `my-queue`.'
     */
    #[JsonProperty('entityPath')]
    private ?string $entityPath;

    /**
     * @var ?int $expiration Optional expiration in minutes for the generated token. Defaults to 5 minutes.
     */
    #[JsonProperty('expiration')]
    private ?int $expiration;

    /**
     * @param array{
     *   namespace?: ?string,
     *   sasKeyName?: ?string,
     *   sasKey?: ?string,
     *   entityPath?: ?string,
     *   expiration?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->namespace = $values['namespace'] ?? null;
        $this->sasKeyName = $values['sasKeyName'] ?? null;
        $this->sasKey = $values['sasKey'] ?? null;
        $this->entityPath = $values['entityPath'] ?? null;
        $this->expiration = $values['expiration'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    /**
     * @param ?string $value
     */
    public function setNamespace(?string $value = null): self
    {
        $this->namespace = $value;
        $this->_setField('namespace');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSasKeyName(): ?string
    {
        return $this->sasKeyName;
    }

    /**
     * @param ?string $value
     */
    public function setSasKeyName(?string $value = null): self
    {
        $this->sasKeyName = $value;
        $this->_setField('sasKeyName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSasKey(): ?string
    {
        return $this->sasKey;
    }

    /**
     * @param ?string $value
     */
    public function setSasKey(?string $value = null): self
    {
        $this->sasKey = $value;
        $this->_setField('sasKey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEntityPath(): ?string
    {
        return $this->entityPath;
    }

    /**
     * @param ?string $value
     */
    public function setEntityPath(?string $value = null): self
    {
        $this->entityPath = $value;
        $this->_setField('entityPath');
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
