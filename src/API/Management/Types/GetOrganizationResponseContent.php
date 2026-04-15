<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class GetOrganizationResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id Organization identifier.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of this organization.
     */
    #[JsonProperty('name')]
    private ?string $name;

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
     * @var ?TokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?TokenQuota $tokenQuota;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   displayName?: ?string,
     *   branding?: ?OrganizationBranding,
     *   metadata?: ?array<string, ?string>,
     *   tokenQuota?: ?TokenQuota,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->branding = $values['branding'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->tokenQuota = $values['tokenQuota'] ?? null;
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
     * @return ?TokenQuota
     */
    public function getTokenQuota(): ?TokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?TokenQuota $value
     */
    public function setTokenQuota(?TokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
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
