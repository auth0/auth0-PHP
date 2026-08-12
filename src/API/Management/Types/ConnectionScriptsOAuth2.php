<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Custom scripts to transform user profile data or modify OAuth2 flow behavior
 */
class ConnectionScriptsOAuth2 extends JsonSerializableType
{
    /**
     * @var ?string $fetchUserProfile Custom JavaScript function to retrieve and transform user profile data from the identity provider. Called with the access token and token exchange response. Must return a user profile object. Executed in a sandboxed environment. If not provided, an empty profile object is used.
     */
    #[JsonProperty('fetchUserProfile')]
    private ?string $fetchUserProfile;

    /**
     * @var ?string $getLogoutUrl Custom JavaScript function to dynamically construct the logout URL for the identity provider. Called with the request query parameters and must invoke a callback with the logout URL. Only used if 'logoutUrl' is not configured. Executed in a sandboxed environment.
     */
    #[JsonProperty('getLogoutUrl')]
    private ?string $getLogoutUrl;

    /**
     * @param array{
     *   fetchUserProfile?: ?string,
     *   getLogoutUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fetchUserProfile = $values['fetchUserProfile'] ?? null;
        $this->getLogoutUrl = $values['getLogoutUrl'] ?? null;
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
     * @return ?string
     */
    public function getGetLogoutUrl(): ?string
    {
        return $this->getLogoutUrl;
    }

    /**
     * @param ?string $value
     */
    public function setGetLogoutUrl(?string $value = null): self
    {
        $this->getLogoutUrl = $value;
        $this->_setField('getLogoutUrl');
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
