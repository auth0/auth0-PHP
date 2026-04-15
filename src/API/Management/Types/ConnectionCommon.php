<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class ConnectionCommon extends JsonSerializableType
{
    /**
     * @var ?string $displayName
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?array<string> $enabledClients
     */
    #[JsonProperty('enabled_clients'), ArrayType(['string'])]
    private ?array $enabledClients;

    /**
     * @var ?bool $isDomainConnection
     */
    #[JsonProperty('is_domain_connection')]
    private ?bool $isDomainConnection;

    /**
     * @var ?array<string, ?string> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $metadata;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getEnabledClients(): ?array
    {
        return $this->enabledClients;
    }

    /**
     * @param ?array<string> $value
     */
    public function setEnabledClients(?array $value = null): self
    {
        $this->enabledClients = $value;
        $this->_setField('enabledClients');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsDomainConnection(): ?bool
    {
        return $this->isDomainConnection;
    }

    /**
     * @param ?bool $value
     */
    public function setIsDomainConnection(?bool $value = null): self
    {
        $this->isDomainConnection = $value;
        $this->_setField('isDomainConnection');
        return $this;
    }

    /**
     * @return ?array<string, ?string>
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param ?array<string, ?string> $value
     */
    public function setMetadata(?array $value = null): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
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
