<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateSessionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The ID of the session
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
     * )|null $updatedAt
     */
    #[JsonProperty('updated_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $updatedAt;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $authenticatedAt
     */
    #[JsonProperty('authenticated_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $authenticatedAt;

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
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $lastInteractedAt
     */
    #[JsonProperty('last_interacted_at'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $lastInteractedAt;

    /**
     * @var ?SessionDeviceMetadata $device
     */
    #[JsonProperty('device')]
    private ?SessionDeviceMetadata $device;

    /**
     * @var ?array<SessionClientMetadata> $clients List of client details for the session
     */
    #[JsonProperty('clients'), ArrayType([SessionClientMetadata::class])]
    private ?array $clients;

    /**
     * @var ?SessionAuthenticationSignals $authentication
     */
    #[JsonProperty('authentication')]
    private ?SessionAuthenticationSignals $authentication;

    /**
     * @var ?SessionCookieMetadata $cookie
     */
    #[JsonProperty('cookie')]
    private ?SessionCookieMetadata $cookie;

    /**
     * @var ?array<string, mixed> $sessionMetadata
     */
    #[JsonProperty('session_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $sessionMetadata;

    /**
     * @param array{
     *   id?: ?string,
     *   userId?: ?string,
     *   createdAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   updatedAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   authenticatedAt?: (
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
     *   lastInteractedAt?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   device?: ?SessionDeviceMetadata,
     *   clients?: ?array<SessionClientMetadata>,
     *   authentication?: ?SessionAuthenticationSignals,
     *   cookie?: ?SessionCookieMetadata,
     *   sessionMetadata?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->authenticatedAt = $values['authenticatedAt'] ?? null;
        $this->idleExpiresAt = $values['idleExpiresAt'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->lastInteractedAt = $values['lastInteractedAt'] ?? null;
        $this->device = $values['device'] ?? null;
        $this->clients = $values['clients'] ?? null;
        $this->authentication = $values['authentication'] ?? null;
        $this->cookie = $values['cookie'] ?? null;
        $this->sessionMetadata = $values['sessionMetadata'] ?? null;
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
    public function getUpdatedAt(): DateTime|array|null
    {
        return $this->updatedAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setUpdatedAt(DateTime|array|null $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getAuthenticatedAt(): DateTime|array|null
    {
        return $this->authenticatedAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setAuthenticatedAt(DateTime|array|null $value = null): self
    {
        $this->authenticatedAt = $value;
        $this->_setField('authenticatedAt');
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
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getLastInteractedAt(): DateTime|array|null
    {
        return $this->lastInteractedAt;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setLastInteractedAt(DateTime|array|null $value = null): self
    {
        $this->lastInteractedAt = $value;
        $this->_setField('lastInteractedAt');
        return $this;
    }

    /**
     * @return ?SessionDeviceMetadata
     */
    public function getDevice(): ?SessionDeviceMetadata
    {
        return $this->device;
    }

    /**
     * @param ?SessionDeviceMetadata $value
     */
    public function setDevice(?SessionDeviceMetadata $value = null): self
    {
        $this->device = $value;
        $this->_setField('device');
        return $this;
    }

    /**
     * @return ?array<SessionClientMetadata>
     */
    public function getClients(): ?array
    {
        return $this->clients;
    }

    /**
     * @param ?array<SessionClientMetadata> $value
     */
    public function setClients(?array $value = null): self
    {
        $this->clients = $value;
        $this->_setField('clients');
        return $this;
    }

    /**
     * @return ?SessionAuthenticationSignals
     */
    public function getAuthentication(): ?SessionAuthenticationSignals
    {
        return $this->authentication;
    }

    /**
     * @param ?SessionAuthenticationSignals $value
     */
    public function setAuthentication(?SessionAuthenticationSignals $value = null): self
    {
        $this->authentication = $value;
        $this->_setField('authentication');
        return $this;
    }

    /**
     * @return ?SessionCookieMetadata
     */
    public function getCookie(): ?SessionCookieMetadata
    {
        return $this->cookie;
    }

    /**
     * @param ?SessionCookieMetadata $value
     */
    public function setCookie(?SessionCookieMetadata $value = null): self
    {
        $this->cookie = $value;
        $this->_setField('cookie');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getSessionMetadata(): ?array
    {
        return $this->sessionMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setSessionMetadata(?array $value = null): self
    {
        $this->sessionMetadata = $value;
        $this->_setField('sessionMetadata');
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
