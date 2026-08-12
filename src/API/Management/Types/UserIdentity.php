<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class UserIdentity extends JsonSerializableType
{
    /**
     * @var string $connection Connection name of this identity.
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var (
     *    string
     *   |int
     * ) $userId user_id of this identity.
     */
    #[JsonProperty('user_id'), Union('string', 'integer')]
    private string|int $userId;

    /**
     * @var string $provider Type of identity provider.
     */
    #[JsonProperty('provider')]
    private string $provider;

    /**
     * @var ?UserProfileData $profileData
     */
    #[JsonProperty('profileData')]
    private ?UserProfileData $profileData;

    /**
     * @var ?bool $isSocial Whether the identity provider is a social provider (true) or not (false).
     */
    #[JsonProperty('isSocial')]
    private ?bool $isSocial;

    /**
     * @var ?string $accessToken IDP access token returned if scope `read:user_idp_tokens` is defined.
     */
    #[JsonProperty('access_token')]
    private ?string $accessToken;

    /**
     * @var ?string $accessTokenSecret IDP access token secret returned only if `scope read:user_idp_tokens` is defined.
     */
    #[JsonProperty('access_token_secret')]
    private ?string $accessTokenSecret;

    /**
     * @var ?string $refreshToken IDP refresh token returned only if scope `read:user_idp_tokens` is defined.
     */
    #[JsonProperty('refresh_token')]
    private ?string $refreshToken;

    /**
     * @param array{
     *   connection: string,
     *   userId: (
     *    string
     *   |int
     * ),
     *   provider: string,
     *   profileData?: ?UserProfileData,
     *   isSocial?: ?bool,
     *   accessToken?: ?string,
     *   accessTokenSecret?: ?string,
     *   refreshToken?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connection = $values['connection'];
        $this->userId = $values['userId'];
        $this->provider = $values['provider'];
        $this->profileData = $values['profileData'] ?? null;
        $this->isSocial = $values['isSocial'] ?? null;
        $this->accessToken = $values['accessToken'] ?? null;
        $this->accessTokenSecret = $values['accessTokenSecret'] ?? null;
        $this->refreshToken = $values['refreshToken'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnection(): string
    {
        return $this->connection;
    }

    /**
     * @param string $value
     */
    public function setConnection(string $value): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |int
     * )
     */
    public function getUserId(): string|int
    {
        return $this->userId;
    }

    /**
     * @param (
     *    string
     *   |int
     * ) $value
     */
    public function setUserId(string|int $value): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param string $value
     */
    public function setProvider(string $value): self
    {
        $this->provider = $value;
        $this->_setField('provider');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
