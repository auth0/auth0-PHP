<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * The identity object for custom identity providers.
 */
class EventStreamCloudEventUserCreatedObjectIdentitiesItemCustom extends JsonSerializableType
{
    /**
     * @var string $connection Name of the connection containing this identity.
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var (
     *    string
     *   |int
     * ) $userId
     */
    #[JsonProperty('user_id'), Union('string', 'integer')]
    private string|int $userId;

    /**
     * @var ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData $profileData
     */
    #[JsonProperty('profileData')]
    private ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData $profileData;

    /**
     * @var value-of<EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProviderEnum> $provider
     */
    #[JsonProperty('provider')]
    private string $provider;

    /**
     * @var bool $isSocial
     */
    #[JsonProperty('isSocial')]
    private bool $isSocial;

    /**
     * @param array{
     *   connection: string,
     *   userId: (
     *    string
     *   |int
     * ),
     *   provider: value-of<EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProviderEnum>,
     *   isSocial: bool,
     *   profileData?: ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connection = $values['connection'];
        $this->userId = $values['userId'];
        $this->profileData = $values['profileData'] ?? null;
        $this->provider = $values['provider'];
        $this->isSocial = $values['isSocial'];
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
     * @return ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData
     */
    public function getProfileData(): ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData
    {
        return $this->profileData;
    }

    /**
     * @param ?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData $value
     */
    public function setProfileData(?EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProfileData $value = null): self
    {
        $this->profileData = $value;
        $this->_setField('profileData');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProviderEnum>
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @param value-of<EventStreamCloudEventUserCreatedObjectIdentitiesItemCustomProviderEnum> $value
     */
    public function setProvider(string $value): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSocial(): bool
    {
        return $this->isSocial;
    }

    /**
     * @param bool $value
     */
    public function setIsSocial(bool $value): self
    {
        $this->isSocial = $value;
        $this->_setField('isSocial');
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
