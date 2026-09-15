<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Custom configuration for access tokens
 */
class ResourceServerAccessToken extends JsonSerializableType
{
    /**
     * @var ?ResourceServerAccessTokenClaimsMapping $claimsMapping
     */
    #[JsonProperty('claims_mapping')]
    private ?ResourceServerAccessTokenClaimsMapping $claimsMapping;

    /**
     * @param array{
     *   claimsMapping?: ?ResourceServerAccessTokenClaimsMapping,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->claimsMapping = $values['claimsMapping'] ?? null;
    }

    /**
     * @return ?ResourceServerAccessTokenClaimsMapping
     */
    public function getClaimsMapping(): ?ResourceServerAccessTokenClaimsMapping
    {
        return $this->claimsMapping;
    }

    /**
     * @param ?ResourceServerAccessTokenClaimsMapping $value
     */
    public function setClaimsMapping(?ResourceServerAccessTokenClaimsMapping $value = null): self
    {
        $this->claimsMapping = $value;
        $this->_setField('claimsMapping');
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
