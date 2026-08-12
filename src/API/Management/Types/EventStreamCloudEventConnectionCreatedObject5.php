<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class EventStreamCloudEventConnectionCreatedObject5 extends JsonSerializableType
{
    /**
     * @var ?EventStreamCloudEventConnectionCreatedObject5Authentication $authentication
     */
    #[JsonProperty('authentication')]
    private ?EventStreamCloudEventConnectionCreatedObject5Authentication $authentication;

    /**
     * @var ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts $connectedAccounts
     */
    #[JsonProperty('connected_accounts')]
    private ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts $connectedAccounts;

    /**
     * @var ?string $displayName Connection name used in the new universal login experience
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?array<string> $enabledClients Use of this property is NOT RECOMMENDED. Use the PATCH /v2/connections/{id}/clients endpoint to enable the connection for a set of clients.
     */
    #[JsonProperty('enabled_clients'), ArrayType(['string'])]
    private ?array $enabledClients;

    /**
     * @var string $id The connection's identifier
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?bool $isDomainConnection <code>true</code> promotes to a domain-level connection so that third-party applications can use it. <code>false</code> does not promote the connection, so only first-party applications with the connection enabled can use it. (Defaults to <code>false</code>.)
     */
    #[JsonProperty('is_domain_connection')]
    private ?bool $isDomainConnection;

    /**
     * @var ?EventStreamCloudEventConnectionCreatedObject5Metadata $metadata
     */
    #[JsonProperty('metadata')]
    private ?EventStreamCloudEventConnectionCreatedObject5Metadata $metadata;

    /**
     * @var string $name The name of the connection. Must start and end with an alphanumeric character and can only contain alphanumeric characters and '-'. Max length 128
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?array<string> $realms Defines the realms for which the connection will be used (ie: email domains). If the array is empty or the property is not specified, the connection name will be added as realm.
     */
    #[JsonProperty('realms'), ArrayType(['string'])]
    private ?array $realms;

    /**
     * @var ?EventStreamCloudEventConnectionCreatedObject5Options $options
     */
    #[JsonProperty('options')]
    private ?EventStreamCloudEventConnectionCreatedObject5Options $options;

    /**
     * @var value-of<EventStreamCloudEventConnectionCreatedObject5StrategyEnum> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<EventStreamCloudEventConnectionCreatedObject5StrategyEnum>,
     *   authentication?: ?EventStreamCloudEventConnectionCreatedObject5Authentication,
     *   connectedAccounts?: ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts,
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?EventStreamCloudEventConnectionCreatedObject5Metadata,
     *   realms?: ?array<string>,
     *   options?: ?EventStreamCloudEventConnectionCreatedObject5Options,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->id = $values['id'];
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->name = $values['name'];
        $this->realms = $values['realms'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->strategy = $values['strategy'];
    }

    /**
     * @return ?EventStreamCloudEventConnectionCreatedObject5Authentication
     */
    public function getAuthentication(): ?EventStreamCloudEventConnectionCreatedObject5Authentication
    {
        return $this->authentication;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedObject5Authentication $value
     */
    public function setAuthentication(?EventStreamCloudEventConnectionCreatedObject5Authentication $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts
     */
    public function getConnectedAccounts(): ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts
    {
        return $this->connectedAccounts;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts $value
     */
    public function setConnectedAccounts(?EventStreamCloudEventConnectionCreatedObject5ConnectedAccounts $value = null): self
    {
        $this->connectedAccounts = $value;
        $this->_setField('connectedAccounts');
        return $this;
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
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
     * @return ?EventStreamCloudEventConnectionCreatedObject5Metadata
     */
    public function getMetadata(): ?EventStreamCloudEventConnectionCreatedObject5Metadata
    {
        return $this->metadata;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedObject5Metadata $value
     */
    public function setMetadata(?EventStreamCloudEventConnectionCreatedObject5Metadata $value = null): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRealms(): ?array
    {
        return $this->realms;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRealms(?array $value = null): self
    {
        $this->realms = $value;
        $this->_setField('realms');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionCreatedObject5Options
     */
    public function getOptions(): ?EventStreamCloudEventConnectionCreatedObject5Options
    {
        return $this->options;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedObject5Options $value
     */
    public function setOptions(?EventStreamCloudEventConnectionCreatedObject5Options $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventConnectionCreatedObject5StrategyEnum>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<EventStreamCloudEventConnectionCreatedObject5StrategyEnum> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
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
