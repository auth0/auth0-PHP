<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UserIdentitySchema extends JsonSerializableType
{
    /**
     * @var ?string $connection Name of the connection containing this identity.
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @var ?string $userId Unique identifier of the user user for this identity.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?value-of<UserIdentityProviderEnum> $provider
     */
    #[JsonProperty('provider')]
    private ?string $provider;

    /**
     * @var ?bool $isSocial Whether this identity is from a social provider (true) or not (false).
     */
    #[JsonProperty('isSocial')]
    private ?bool $isSocial;

    /**
     * @var ?string $accessToken IDP access token returned only if scope read:user_idp_tokens is defined.
     */
    #[JsonProperty('access_token')]
    private ?string $accessToken;

    /**
     * @var ?string $accessTokenSecret IDP access token secret returned only if scope read:user_idp_tokens is defined.
     */
    #[JsonProperty('access_token_secret')]
    private ?string $accessTokenSecret;

    /**
     * @var ?string $refreshToken IDP refresh token returned only if scope read:user_idp_tokens is defined.
     */
    #[JsonProperty('refresh_token')]
    private ?string $refreshToken;

    /**
     * @var ?UserProfileData $profileData
     */
    #[JsonProperty('profileData')]
    private ?UserProfileData $profileData;

    /**
     * @param array{
     *   connection?: ?string,
     *   userId?: ?string,
     *   provider?: ?value-of<UserIdentityProviderEnum>,
     *   isSocial?: ?bool,
     *   accessToken?: ?string,
     *   accessTokenSecret?: ?string,
     *   refreshToken?: ?string,
     *   profileData?: ?UserProfileData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connection = $values['connection'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->provider = $values['provider'] ?? null;
        $this->isSocial = $values['isSocial'] ?? null;
        $this->accessToken = $values['accessToken'] ?? null;
        $this->accessTokenSecret = $values['accessTokenSecret'] ?? null;
        $this->refreshToken = $values['refreshToken'] ?? null;
        $this->profileData = $values['profileData'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnection(): ?string
    {
        return $this->connection;
    }

    /**
     * @param ?string $value
     */
    public function setConnection(?string $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param ?string $value
     */
    public function setUserId(?string $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?value-of<UserIdentityProviderEnum>
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param ?value-of<UserIdentityProviderEnum> $value
     */
    public function setProvider(?string $value = null): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsSocial(): ?bool
    {
        return $this->isSocial;
    }

    /**
     * @param ?bool $value
     */
    public function setIsSocial(?bool $value = null): self
    {
        $this->isSocial = $value;
        $this->_setField('isSocial');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param ?string $value
     */
    public function setAccessToken(?string $value = null): self
    {
        $this->accessToken = $value;
        $this->_setField('accessToken');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAccessTokenSecret(): ?string
    {
        return $this->accessTokenSecret;
    }

    /**
     * @param ?string $value
     */
    public function setAccessTokenSecret(?string $value = null): self
    {
        $this->accessTokenSecret = $value;
        $this->_setField('accessTokenSecret');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * @param ?string $value
     */
    public function setRefreshToken(?string $value = null): self
    {
        $this->refreshToken = $value;
        $this->_setField('refreshToken');
        return $this;
    }

    /**
     * @return ?UserProfileData
     */
    public function getProfileData(): ?UserProfileData
    {
        return $this->profileData;
    }

    /**
     * @param ?UserProfileData $value
     */
    public function setProfileData(?UserProfileData $value = null): self
    {
        $this->profileData = $value;
        $this->_setField('profileData');
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
