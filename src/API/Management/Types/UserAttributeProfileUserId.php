<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * User ID mapping configuration
 */
class UserAttributeProfileUserId extends JsonSerializableType
{
    /**
     * @var ?value-of<UserAttributeProfileUserIdOidcMappingEnum> $oidcMapping
     */
    #[JsonProperty('oidc_mapping')]
    private ?string $oidcMapping;

    /**
     * @var ?array<string> $samlMapping
     */
    #[JsonProperty('saml_mapping'), ArrayType(['string'])]
    private ?array $samlMapping;

    /**
     * @var ?string $scimMapping SCIM mapping for user ID
     */
    #[JsonProperty('scim_mapping')]
    private ?string $scimMapping;

    /**
     * @var ?UserAttributeProfileStrategyOverridesUserId $strategyOverrides
     */
    #[JsonProperty('strategy_overrides')]
    private ?UserAttributeProfileStrategyOverridesUserId $strategyOverrides;

    /**
     * @param array{
     *   oidcMapping?: ?value-of<UserAttributeProfileUserIdOidcMappingEnum>,
     *   samlMapping?: ?array<string>,
     *   scimMapping?: ?string,
     *   strategyOverrides?: ?UserAttributeProfileStrategyOverridesUserId,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->oidcMapping = $values['oidcMapping'] ?? null;
        $this->samlMapping = $values['samlMapping'] ?? null;
        $this->scimMapping = $values['scimMapping'] ?? null;
        $this->strategyOverrides = $values['strategyOverrides'] ?? null;
    }

    /**
     * @return ?value-of<UserAttributeProfileUserIdOidcMappingEnum>
     */
    public function getOidcMapping(): ?string
    {
        return $this->oidcMapping;
    }

    /**
     * @param ?value-of<UserAttributeProfileUserIdOidcMappingEnum> $value
     */
    public function setOidcMapping(?string $value = null): self
    {
        $this->oidcMapping = $value;
        $this->_setField('oidcMapping');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getSamlMapping(): ?array
    {
        return $this->samlMapping;
    }

    /**
     * @param ?array<string> $value
     */
    public function setSamlMapping(?array $value = null): self
    {
        $this->samlMapping = $value;
        $this->_setField('samlMapping');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScimMapping(): ?string
    {
        return $this->scimMapping;
    }

    /**
     * @param ?string $value
     */
    public function setScimMapping(?string $value = null): self
    {
        $this->scimMapping = $value;
        $this->_setField('scimMapping');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileStrategyOverridesUserId
     */
    public function getStrategyOverrides(): ?UserAttributeProfileStrategyOverridesUserId
    {
        return $this->strategyOverrides;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverridesUserId $value
     */
    public function setStrategyOverrides(?UserAttributeProfileStrategyOverridesUserId $value = null): self
    {
        $this->strategyOverrides = $value;
        $this->_setField('strategyOverrides');
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
