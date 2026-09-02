<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class EventStreamCloudEventConnectionDeletedPreviousObject7 extends JsonSerializableType
{
    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication $authentication
     */
    #[JsonProperty('authentication')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication $authentication;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts $connectedAccounts
     */
    #[JsonProperty('connected_accounts')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts $connectedAccounts;

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
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata $metadata
     */
    #[JsonProperty('metadata')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata $metadata;

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
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject7Options $options
     */
    #[JsonProperty('options')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject7Options $options;

    /**
     * @var ?bool $showAsButton Enables showing a button for the connection in the login page (new experience only). If false, it will be usable only by HRD. Defaults to `false`.
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @var value-of<EventStreamCloudEventConnectionDeletedPreviousObject7StrategyEnum> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   strategy: value-of<EventStreamCloudEventConnectionDeletedPreviousObject7StrategyEnum>,
     *   authentication?: ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication,
     *   connectedAccounts?: ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts,
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata,
     *   realms?: ?array<string>,
     *   options?: ?EventStreamCloudEventConnectionDeletedPreviousObject7Options,
     *   showAsButton?: ?bool,
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
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->strategy = $values['strategy'];
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication
     */
    public function getAuthentication(): ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication
    {
        return $this->authentication;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication $value
     */
    public function setAuthentication(?EventStreamCloudEventConnectionDeletedPreviousObject7Authentication $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts
     */
    public function getConnectedAccounts(): ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts
    {
        return $this->connectedAccounts;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts $value
     */
    public function setConnectedAccounts(?EventStreamCloudEventConnectionDeletedPreviousObject7ConnectedAccounts $value = null): self
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
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata
     */
    public function getMetadata(): ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata
    {
        return $this->metadata;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata $value
     */
    public function setMetadata(?EventStreamCloudEventConnectionDeletedPreviousObject7Metadata $value = null): self
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
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject7Options
     */
    public function getOptions(): ?EventStreamCloudEventConnectionDeletedPreviousObject7Options
    {
        return $this->options;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject7Options $value
     */
    public function setOptions(?EventStreamCloudEventConnectionDeletedPreviousObject7Options $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShowAsButton(): ?bool
    {
        return $this->showAsButton;
    }

    /**
     * @param ?bool $value
     */
    public function setShowAsButton(?bool $value = null): self
    {
        $this->showAsButton = $value;
        $this->_setField('showAsButton');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventConnectionDeletedPreviousObject7StrategyEnum>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<EventStreamCloudEventConnectionDeletedPreviousObject7StrategyEnum> $value
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
