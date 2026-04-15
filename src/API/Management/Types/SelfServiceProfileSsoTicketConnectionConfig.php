<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * If provided, this will create a new connection for the SSO flow with the given configuration
 */
class SelfServiceProfileSsoTicketConnectionConfig extends JsonSerializableType
{
    /**
     * @var string $name The name of the connection that will be created as a part of the SSO flow.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $displayName Connection name used in the new universal login experience
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

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
     * @var ?array<string, ?string> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $metadata;

    /**
     * @var ?SelfServiceProfileSsoTicketConnectionOptions $options
     */
    #[JsonProperty('options')]
    private ?SelfServiceProfileSsoTicketConnectionOptions $options;

    /**
     * @param array{
     *   name: string,
     *   displayName?: ?string,
     *   isDomainConnection?: ?bool,
     *   showAsButton?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?SelfServiceProfileSsoTicketConnectionOptions,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->displayName = $values['displayName'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->options = $values['options'] ?? null;
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
     * @return ?SelfServiceProfileSsoTicketConnectionOptions
     */
    public function getOptions(): ?SelfServiceProfileSsoTicketConnectionOptions
    {
        return $this->options;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketConnectionOptions $value
     */
    public function setOptions(?SelfServiceProfileSsoTicketConnectionOptions $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
