<?php

namespace Auth0\SDK\API\Management\Organizations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\OrganizationBranding;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\ConnectionForOrganization;
use Auth0\SDK\API\Management\Types\CreateTokenQuota;

class CreateOrganizationRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The name of this organization.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $displayName Friendly name of this organization.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?OrganizationBranding $branding
     */
    #[JsonProperty('branding')]
    private ?OrganizationBranding $branding;

    /**
     * @var ?array<string, ?string> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => new Union('string', 'null')])]
    private ?array $metadata;

    /**
     * @var ?array<ConnectionForOrganization> $enabledConnections Connections that will be enabled for this organization. See POST enabled_connections endpoint for the object format. (Max of 10 connections allowed)
     */
    #[JsonProperty('enabled_connections'), ArrayType([ConnectionForOrganization::class])]
    private ?array $enabledConnections;

    /**
     * @var ?CreateTokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?CreateTokenQuota $tokenQuota;

    /**
     * @param array{
     *   name: string,
     *   displayName?: ?string,
     *   branding?: ?OrganizationBranding,
     *   metadata?: ?array<string, ?string>,
     *   enabledConnections?: ?array<ConnectionForOrganization>,
     *   tokenQuota?: ?CreateTokenQuota,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->displayName = $values['displayName'] ?? null;
        $this->branding = $values['branding'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->enabledConnections = $values['enabledConnections'] ?? null;
        $this->tokenQuota = $values['tokenQuota'] ?? null;
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
     * @return ?OrganizationBranding
     */
    public function getBranding(): ?OrganizationBranding
    {
        return $this->branding;
    }

    /**
     * @param ?OrganizationBranding $value
     */
    public function setBranding(?OrganizationBranding $value = null): self
    {
        $this->branding = $value;
        $this->_setField('branding');
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
     * @return ?array<ConnectionForOrganization>
     */
    public function getEnabledConnections(): ?array
    {
        return $this->enabledConnections;
    }

    /**
     * @param ?array<ConnectionForOrganization> $value
     */
    public function setEnabledConnections(?array $value = null): self
    {
        $this->enabledConnections = $value;
        $this->_setField('enabledConnections');
        return $this;
    }

    /**
     * @return ?CreateTokenQuota
     */
    public function getTokenQuota(): ?CreateTokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?CreateTokenQuota $value
     */
    public function setTokenQuota(?CreateTokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
        return $this;
    }
}
