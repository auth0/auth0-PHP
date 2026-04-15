<?php

namespace Auth0\SDK\API\Management\Connections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ConnectionIdentityProviderEnum;
use Auth0\SDK\API\Management\Types\ConnectionPropertiesOptions;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\ConnectionAuthenticationPurpose;
use Auth0\SDK\API\Management\Types\ConnectionConnectedAccountsPurpose;

class CreateConnectionRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The name of the connection. Must start and end with an alphanumeric character and can only contain alphanumeric characters and '-'. Max length 128
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $displayName Connection name used in the new universal login experience
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var value-of<ConnectionIdentityProviderEnum> $strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var ?ConnectionPropertiesOptions $options
     */
    #[JsonProperty('options')]
    private ?ConnectionPropertiesOptions $options;

    /**
     * @var ?array<string> $enabledClients Use of this property is NOT RECOMMENDED. Use the PATCH /v2/connections/{id}/clients endpoint to enable the connection for a set of clients.
     */
    #[JsonProperty('enabled_clients'), ArrayType(['string'])]
    private ?array $enabledClients;

    /**
     * @var ?bool $isDomainConnection <code>true</code> promotes to a domain-level connection so that third-party applications can use it. <code>false</code> does not promote the connection, so only first-party applications with the connection enabled can use it. (Defaults to <code>false</code>.)
     */
    #[JsonProperty('is_domain_connection')]
    private ?bool $isDomainConnection;

    /**
     * @var ?bool $showAsButton Enables showing a button for the connection in the login page (new experience only). If false, it will be usable only by HRD. (Defaults to <code>false</code>.)
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @var ?array<string> $realms Defines the realms for which the connection will be used (ie: email domains). If the array is empty or the property is not specified, the connection name will be added as realm.
     */
    #[JsonProperty('realms'), ArrayType(['string'])]
    private ?array $realms;

    /**
     * @var ?array<string, ?string> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $metadata;

    /**
     * @var ?ConnectionAuthenticationPurpose $authentication
     */
    #[JsonProperty('authentication')]
    private ?ConnectionAuthenticationPurpose $authentication;

    /**
     * @var ?ConnectionConnectedAccountsPurpose $connectedAccounts
     */
    #[JsonProperty('connected_accounts')]
    private ?ConnectionConnectedAccountsPurpose $connectedAccounts;

    /**
     * @param array{
     *   name: string,
     *   strategy: value-of<ConnectionIdentityProviderEnum>,
     *   displayName?: ?string,
     *   options?: ?ConnectionPropertiesOptions,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   showAsButton?: ?bool,
     *   realms?: ?array<string>,
     *   metadata?: ?array<string, ?string>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->displayName = $values['displayName'] ?? null;
        $this->strategy = $values['strategy'];
        $this->options = $values['options'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->realms = $values['realms'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
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
     * @return value-of<ConnectionIdentityProviderEnum>
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param value-of<ConnectionIdentityProviderEnum> $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?ConnectionPropertiesOptions
     */
    public function getOptions(): ?ConnectionPropertiesOptions
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionPropertiesOptions $value
     */
    public function setOptions(?ConnectionPropertiesOptions $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
     * @return ?ConnectionAuthenticationPurpose
     */
    public function getAuthentication(): ?ConnectionAuthenticationPurpose
    {
        return $this->authentication;
    }

    /**
     * @param ?ConnectionAuthenticationPurpose $value
     */
    public function setAuthentication(?ConnectionAuthenticationPurpose $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?ConnectionConnectedAccountsPurpose
     */
    public function getConnectedAccounts(): ?ConnectionConnectedAccountsPurpose
    {
        return $this->connectedAccounts;
    }

    /**
     * @param ?ConnectionConnectedAccountsPurpose $value
     */
    public function setConnectedAccounts(?ConnectionConnectedAccountsPurpose $value = null): self
    {
        $this->connectedAccounts = $value;
        $this->_setField('connectedAccounts');
        return $this;
    }
}
