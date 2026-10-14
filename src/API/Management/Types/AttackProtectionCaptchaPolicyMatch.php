<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Traffic matching criteria for the policy. Exactly one of auth0_managed or geo_country_codes must be specified.
 */
class AttackProtectionCaptchaPolicyMatch extends JsonSerializableType
{
    /**
     * @var ?array<string> $auth0Managed Match by Auth0-managed traffic identifiers.
     */
    #[JsonProperty('auth0_managed'), ArrayType(['string'])]
    private ?array $auth0Managed;

    /**
     * @var ?array<string> $geoCountryCodes Match by ISO 3166-1 alpha-2 country codes.
     */
    #[JsonProperty('geo_country_codes'), ArrayType(['string'])]
    private ?array $geoCountryCodes;

    /**
     * @param array{
     *   auth0Managed?: ?array<string>,
     *   geoCountryCodes?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->auth0Managed = $values['auth0Managed'] ?? null;
        $this->geoCountryCodes = $values['geoCountryCodes'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getAuth0Managed(): ?array
    {
        return $this->auth0Managed;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAuth0Managed(?array $value = null): self
    {
        $this->auth0Managed = $value;
        $this->_setField('auth0Managed');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getGeoCountryCodes(): ?array
    {
        return $this->geoCountryCodes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setGeoCountryCodes(?array $value = null): self
    {
        $this->geoCountryCodes = $value;
        $this->_setField('geoCountryCodes');
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
