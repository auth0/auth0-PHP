<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Custom configuration for claims in access tokens
 */
class ResourceServerAccessTokenClaimsMapping extends JsonSerializableType
{
    /**
     * @var ?array<ResourceServerAccessTokenCustomClaimsMappingRule> $customClaims
     */
    #[JsonProperty('custom_claims'), ArrayType([ResourceServerAccessTokenCustomClaimsMappingRule::class])]
    private ?array $customClaims;

    /**
     * @param array{
     *   customClaims?: ?array<ResourceServerAccessTokenCustomClaimsMappingRule>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->customClaims = $values['customClaims'] ?? null;
    }

    /**
     * @return ?array<ResourceServerAccessTokenCustomClaimsMappingRule>
     */
    public function getCustomClaims(): ?array
    {
        return $this->customClaims;
    }

    /**
     * @param ?array<ResourceServerAccessTokenCustomClaimsMappingRule> $value
     */
    public function setCustomClaims(?array $value = null): self
    {
        $this->customClaims = $value;
        $this->_setField('customClaims');
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
