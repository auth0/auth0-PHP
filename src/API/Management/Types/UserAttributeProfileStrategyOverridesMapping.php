<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UserAttributeProfileStrategyOverridesMapping extends JsonSerializableType
{
    /**
     * @var ?UserAttributeProfileOidcMapping $oidcMapping OIDC mapping override for this strategy
     */
    #[JsonProperty('oidc_mapping')]
    private ?UserAttributeProfileOidcMapping $oidcMapping;

    /**
     * @var ?array<string> $samlMapping
     */
    #[JsonProperty('saml_mapping'), ArrayType(['string'])]
    private ?array $samlMapping;

    /**
     * @var ?string $scimMapping SCIM mapping override for this strategy
     */
    #[JsonProperty('scim_mapping')]
    private ?string $scimMapping;

    /**
     * @param array{
     *   oidcMapping?: ?UserAttributeProfileOidcMapping,
     *   samlMapping?: ?array<string>,
     *   scimMapping?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->oidcMapping = $values['oidcMapping'] ?? null;
        $this->samlMapping = $values['samlMapping'] ?? null;
        $this->scimMapping = $values['scimMapping'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
