<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Metadata about the associated client.
 */
class OrganizationClientMetadata extends JsonSerializableType
{
    /**
     * @var ?string $name The name of the client.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $appType The type of the client application.
     */
    #[JsonProperty('app_type')]
    private ?string $appType;

    /**
     * @var ?string $logoUri The URI of the client logo.
     */
    #[JsonProperty('logo_uri')]
    private ?string $logoUri;

    /**
     * @var ?bool $isFirstParty Whether this client is a first-party client (true) or not (false).
     */
    #[JsonProperty('is_first_party')]
    private ?bool $isFirstParty;

    /**
     * @var ?array<string> $grantTypes The grant types enabled for the client.
     */
    #[JsonProperty('grant_types'), ArrayType(['string'])]
    private ?array $grantTypes;

    /**
     * @var ?value-of<OrganizationClientMetadataOrganizationUsageEnum> $organizationUsage
     */
    #[JsonProperty('organization_usage')]
    private ?string $organizationUsage;

    /**
     * @param array{
     *   name?: ?string,
     *   appType?: ?string,
     *   logoUri?: ?string,
     *   isFirstParty?: ?bool,
     *   grantTypes?: ?array<string>,
     *   organizationUsage?: ?value-of<OrganizationClientMetadataOrganizationUsageEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->logoUri = $values['logoUri'] ?? null;
        $this->isFirstParty = $values['isFirstParty'] ?? null;
        $this->grantTypes = $values['grantTypes'] ?? null;
        $this->organizationUsage = $values['organizationUsage'] ?? null;
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
    public function getAppType(): ?string
    {
        return $this->appType;
    }

    /**
     * @param ?string $value
     */
    public function setAppType(?string $value = null): self
    {
        $this->appType = $value;
        $this->_setField('appType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLogoUri(): ?string
    {
        return $this->logoUri;
    }

    /**
     * @param ?string $value
     */
    public function setLogoUri(?string $value = null): self
    {
        $this->logoUri = $value;
        $this->_setField('logoUri');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsFirstParty(): ?bool
    {
        return $this->isFirstParty;
    }

    /**
     * @param ?bool $value
     */
    public function setIsFirstParty(?bool $value = null): self
    {
        $this->isFirstParty = $value;
        $this->_setField('isFirstParty');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGrantTypes(): ?array
    {
        return $this->grantTypes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGrantTypes(?array $value = null): self
    {
        $this->grantTypes = $value;
        $this->_setField('grantTypes');
        return $this;
    }

    /**
     * @return ?value-of<OrganizationClientMetadataOrganizationUsageEnum>
     */
    public function getOrganizationUsage(): ?string
    {
        return $this->organizationUsage;
    }

    /**
     * @param ?value-of<OrganizationClientMetadataOrganizationUsageEnum> $value
     */
    public function setOrganizationUsage(?string $value = null): self
    {
        $this->organizationUsage = $value;
        $this->_setField('organizationUsage');
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
