<?php

namespace Auth0\SDK\API\Management\Organizations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\OrganizationBranding;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\UpdateTokenQuota;

class UpdateOrganizationRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $displayName Friendly name of this organization.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?string $name The name of this organization.
     */
    #[JsonProperty('name')]
    private ?string $name;

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
     * @var ?UpdateTokenQuota $tokenQuota
     */
    #[JsonProperty('token_quota')]
    private ?UpdateTokenQuota $tokenQuota;

    /**
     * @param array{
     *   displayName?: ?string,
     *   name?: ?string,
     *   branding?: ?OrganizationBranding,
     *   metadata?: ?array<string, ?string>,
     *   tokenQuota?: ?UpdateTokenQuota,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->branding = $values['branding'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->tokenQuota = $values['tokenQuota'] ?? null;
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
     * @return ?UpdateTokenQuota
     */
    public function getTokenQuota(): ?UpdateTokenQuota
    {
        return $this->tokenQuota;
    }

    /**
     * @param ?UpdateTokenQuota $value
     */
    public function setTokenQuota(?UpdateTokenQuota $value = null): self
    {
        $this->tokenQuota = $value;
        $this->_setField('tokenQuota');
        return $this;
    }
}
