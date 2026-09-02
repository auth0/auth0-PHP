<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The branding associated with the organization.
 */
class EventStreamCloudEventOrgUpdatedPreviousObjectBranding extends JsonSerializableType
{
    /**
     * @var ?string $logoUrl URL of logo to display on login page.
     */
    #[JsonProperty('logo_url')]
    private ?string $logoUrl;

    /**
     * @var ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors $colors
     */
    #[JsonProperty('colors')]
    private ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors $colors;

    /**
     * @param array{
     *   logoUrl?: ?string,
     *   colors?: ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->logoUrl = $values['logoUrl'] ?? null;
        $this->colors = $values['colors'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getLogoUrl(): ?string
    {
        return $this->logoUrl;
    }

    /**
     * @param ?string $value
     */
    public function setLogoUrl(?string $value = null): self
    {
        $this->logoUrl = $value;
        $this->_setField('logoUrl');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors
     */
    public function getColors(): ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors
    {
        return $this->colors;
    }

    /**
     * @param ?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors $value
     */
    public function setColors(?EventStreamCloudEventOrgUpdatedPreviousObjectBrandingColors $value = null): self
    {
        $this->colors = $value;
        $this->_setField('colors');
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
