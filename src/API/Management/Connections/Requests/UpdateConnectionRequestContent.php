<?php

namespace Auth0\SDK\API\Management\Connections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\UpdateConnectionOptions;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\ConnectionAuthenticationPurpose;
use Auth0\SDK\API\Management\Types\ConnectionConnectedAccountsPurpose;

class UpdateConnectionRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $displayName The connection name used in the new universal login experience. If display_name is not included in the request, the field will be overwritten with the name value.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?UpdateConnectionOptions $options
     */
    #[JsonProperty('options')]
    private ?UpdateConnectionOptions $options;

    /**
     * @var ?array<string> $enabledClients DEPRECATED property. Use the PATCH /v2/connections/{id}/clients endpoint to enable or disable the connection for any clients.
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
     *   displayName?: ?string,
     *   options?: ?UpdateConnectionOptions,
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
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
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
     * @return ?UpdateConnectionOptions
     */
    public function getOptions(): ?UpdateConnectionOptions
    {
        return $this->options;
    }

    /**
     * @param ?UpdateConnectionOptions $value
     */
    public function setOptions(?UpdateConnectionOptions $value = null): self
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
