<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class RefreshTokenResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The ID of the refresh token
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $userId ID of the user which can be used when interacting with other APIs.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $createdAt
     */
    #[JsonProperty('created_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $createdAt;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $idleExpiresAt
     */
    #[JsonProperty('idle_expires_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $idleExpiresAt;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $expiresAt
     */
    #[JsonProperty('expires_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $expiresAt;

    /**
     * @var ?RefreshTokenDevice $device
     */
    #[JsonProperty('device')]
    private ?RefreshTokenDevice $device;

    /**
     * @var ?string $clientId ID of the client application granted with this refresh token
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $sessionId
     */
    #[JsonProperty('session_id')]
    private ?string $sessionId;

    /**
     * @var ?bool $rotating True if the token is a rotating refresh token
     */
    #[JsonProperty('rotating')]
    private ?bool $rotating;

    /**
     * @var ?array<RefreshTokenResourceServer> $resourceServers A list of the resource server IDs associated to this refresh-token and their granted scopes
     */
    #[JsonProperty('resource_servers'), ArrayType([RefreshTokenResourceServer::class])]
    private ?array $resourceServers;

    /**
     * @var ?array<string, mixed> $refreshTokenMetadata
     */
    #[JsonProperty('refresh_token_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $refreshTokenMetadata;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $lastExchangedAt
     */
    #[JsonProperty('last_exchanged_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $lastExchangedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   userId?: ?string,
     *   createdAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   idleExpiresAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   expiresAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   device?: ?RefreshTokenDevice,
     *   clientId?: ?string,
     *   sessionId?: ?string,
     *   rotating?: ?bool,
     *   resourceServers?: ?array<RefreshTokenResourceServer>,
     *   refreshTokenMetadata?: ?array<string, mixed>,
     *   lastExchangedAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->idleExpiresAt = $values['idleExpiresAt'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->device = $values['device'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->sessionId = $values['sessionId'] ?? null;
        $this->rotating = $values['rotating'] ?? null;
        $this->resourceServers = $values['resourceServers'] ?? null;
        $this->refreshTokenMetadata = $values['refreshTokenMetadata'] ?? null;
        $this->lastExchangedAt = $values['lastExchangedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
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
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getCreatedAt(): DateTime|array|null
    {
        return $this->createdAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setCreatedAt(DateTime|array|null $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getIdleExpiresAt(): DateTime|array|null
    {
        return $this->idleExpiresAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setIdleExpiresAt(DateTime|array|null $value = null): self
    {
        $this->idleExpiresAt = $value;
        $this->_setField('idleExpiresAt');
        return $this;
    }

    /**
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getExpiresAt(): DateTime|array|null
    {
        return $this->expiresAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setExpiresAt(DateTime|array|null $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
        return $this;
    }

    /**
     * @return ?RefreshTokenDevice
     */
    public function getDevice(): ?RefreshTokenDevice
    {
        return $this->device;
    }

    /**
     * @param ?RefreshTokenDevice $value
     */
    public function setDevice(?RefreshTokenDevice $value = null): self
    {
        $this->device = $value;
        $this->_setField('device');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @param ?string $value
     */
    public function setSessionId(?string $value = null): self
    {
        $this->sessionId = $value;
        $this->_setField('sessionId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRotating(): ?bool
    {
        return $this->rotating;
    }

    /**
     * @param ?bool $value
     */
    public function setRotating(?bool $value = null): self
    {
        $this->rotating = $value;
        $this->_setField('rotating');
        return $this;
    }

    /**
     * @return ?array<RefreshTokenResourceServer>
     */
    public function getResourceServers(): ?array
    {
        return $this->resourceServers;
    }

    /**
     * @param ?array<RefreshTokenResourceServer> $value
     */
    public function setResourceServers(?array $value = null): self
    {
        $this->resourceServers = $value;
        $this->_setField('resourceServers');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getRefreshTokenMetadata(): ?array
    {
        return $this->refreshTokenMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setRefreshTokenMetadata(?array $value = null): self
    {
        $this->refreshTokenMetadata = $value;
        $this->_setField('refreshTokenMetadata');
        return $this;
    }

    /**
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getLastExchangedAt(): DateTime|array|null
    {
        return $this->lastExchangedAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setLastExchangedAt(DateTime|array|null $value = null): self
    {
        $this->lastExchangedAt = $value;
        $this->_setField('lastExchangedAt');
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
