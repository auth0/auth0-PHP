<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class ConnectionForList extends JsonSerializableType
{
    /**
     * @var ?string $name The name of the connection
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $displayName Connection name used in login screen
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?array<string, mixed> $options
     */
    #[JsonProperty('options'), ArrayType(['string' => 'mixed'])]
    private ?array $options;

    /**
     * @var ?string $id The connection's identifier
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $strategy The type of the connection, related to the identity provider
     */
    #[JsonProperty('strategy')]
    private ?string $strategy;

    /**
     * @var ?array<string> $realms Defines the realms for which the connection will be used (ie: email domains). If the array is empty or the property is not specified, the connection name will be added as realm.
     */
    #[JsonProperty('realms'), ArrayType(['string'])]
    private ?array $realms;

    /**
     * @var ?bool $isDomainConnection True if the connection is domain level
     */
    #[JsonProperty('is_domain_connection')]
    private ?bool $isDomainConnection;

    /**
     * @var ?bool $showAsButton Enables showing a button for the connection in the login page (new experience only). If false, it will be usable only by HRD.
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

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
     *   name?: ?string,
     *   displayName?: ?string,
     *   options?: ?array<string, mixed>,
     *   id?: ?string,
     *   strategy?: ?string,
     *   realms?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   showAsButton?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->id = $values['id'] ?? null;
        $this->strategy = $values['strategy'] ?? null;
        $this->realms = $values['realms'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
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
     * @return ?array<string, mixed>
     */
    public function getOptions(): ?array
    {
        return $this->options;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setOptions(?array $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param ?string $value
     */
    public function setStrategy(?string $value = null): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
