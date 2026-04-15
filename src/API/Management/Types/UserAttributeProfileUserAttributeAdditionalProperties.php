<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UserAttributeProfileUserAttributeAdditionalProperties extends JsonSerializableType
{
    /**
     * @var string $description Description of this attribute
     */
    #[JsonProperty('description')]
    private string $description;

    /**
     * @var string $label Display label for this attribute
     */
    #[JsonProperty('label')]
    private string $label;

    /**
     * @var bool $profileRequired Whether this attribute is required in the profile
     */
    #[JsonProperty('profile_required')]
    private bool $profileRequired;

    /**
     * @var string $auth0Mapping Auth0 mapping for this attribute
     */
    #[JsonProperty('auth0_mapping')]
    private string $auth0Mapping;

    /**
     * @var ?UserAttributeProfileOidcMapping $oidcMapping
     */
    #[JsonProperty('oidc_mapping')]
    private ?UserAttributeProfileOidcMapping $oidcMapping;

    /**
     * @var ?array<string> $samlMapping SAML mapping for this attribute
     */
    #[JsonProperty('saml_mapping'), ArrayType(['string'])]
    private ?array $samlMapping;

    /**
     * @var ?string $scimMapping SCIM mapping for this attribute
     */
    #[JsonProperty('scim_mapping')]
    private ?string $scimMapping;

    /**
     * @var ?UserAttributeProfileStrategyOverrides $strategyOverrides
     */
    #[JsonProperty('strategy_overrides')]
    private ?UserAttributeProfileStrategyOverrides $strategyOverrides;

    /**
     * @param array{
     *   description: string,
     *   label: string,
     *   profileRequired: bool,
     *   auth0Mapping: string,
     *   oidcMapping?: ?UserAttributeProfileOidcMapping,
     *   samlMapping?: ?array<string>,
     *   scimMapping?: ?string,
     *   strategyOverrides?: ?UserAttributeProfileStrategyOverrides,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->description = $values['description'];
        $this->label = $values['label'];
        $this->profileRequired = $values['profileRequired'];
        $this->auth0Mapping = $values['auth0Mapping'];
        $this->oidcMapping = $values['oidcMapping'] ?? null;
        $this->samlMapping = $values['samlMapping'] ?? null;
        $this->scimMapping = $values['scimMapping'] ?? null;
        $this->strategyOverrides = $values['strategyOverrides'] ?? null;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $value
     */
    public function setDescription(string $value): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $value
     */
    public function setLabel(string $value): self
    {
        $this->label = $value;
        $this->_setField('label');
        return $this;
    }

    /**
     * @return bool
     */
    public function getProfileRequired(): bool
    {
        return $this->profileRequired;
    }

    /**
     * @param bool $value
     */
    public function setProfileRequired(bool $value): self
    {
        $this->profileRequired = $value;
        $this->_setField('profileRequired');
        return $this;
    }

    /**
     * @return string
     */
    public function getAuth0Mapping(): string
    {
        return $this->auth0Mapping;
    }

    /**
     * @param string $value
     */
    public function setAuth0Mapping(string $value): self
    {
        $this->auth0Mapping = $value;
        $this->_setField('auth0Mapping');
        return $this;
    }

    /**
     * @return ?UserAttributeProfileOidcMapping
     */
    public function getOidcMapping(): ?UserAttributeProfileOidcMapping
    {
        return $this->oidcMapping;
    }

    /**
     * @param ?UserAttributeProfileOidcMapping $value
     */
    public function setOidcMapping(?UserAttributeProfileOidcMapping $value = null): self
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
     * @return ?UserAttributeProfileStrategyOverrides
     */
    public function getStrategyOverrides(): ?UserAttributeProfileStrategyOverrides
    {
        return $this->strategyOverrides;
    }

    /**
     * @param ?UserAttributeProfileStrategyOverrides $value
     */
    public function setStrategyOverrides(?UserAttributeProfileStrategyOverrides $value = null): self
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
