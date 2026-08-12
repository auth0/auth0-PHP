<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Custom scripts to transform user profile data or modify OAuth1 flow behavior
 */
class ConnectionScriptsOAuth1 extends JsonSerializableType
{
    /**
     * @var ?string $fetchUserProfile Custom JavaScript function to retrieve and transform user profile data from the identity provider. Called with the access token and token exchange response. Must return a user profile object. Executed in a sandboxed environment. If not provided, an empty profile object is used.
     */
    #[JsonProperty('fetchUserProfile')]
    private ?string $fetchUserProfile;

    /**
     * @param array{
     *   fetchUserProfile?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fetchUserProfile = $values['fetchUserProfile'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFetchUserProfile(): ?string
    {
        return $this->fetchUserProfile;
    }

    /**
     * @param ?string $value
     */
    public function setFetchUserProfile(?string $value = null): self
    {
        $this->fetchUserProfile = $value;
        $this->_setField('fetchUserProfile');
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
