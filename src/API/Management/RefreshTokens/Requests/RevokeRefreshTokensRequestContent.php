<?php

namespace Auth0\SDK\API\Management\RefreshTokens\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class RevokeRefreshTokensRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<string> $ids Array of refresh token IDs to revoke. Limited to 100 at a time.
     */
    #[JsonProperty('ids'), ArrayType(['string'])]
    private ?array $ids;

    /**
     * @var ?string $userId Revoke all refresh tokens for this user.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?string $clientId Revoke all refresh tokens for this client.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $audience Resource server identifier (audience) to scope the revocation. Must be used with both `user_id` and `client_id`.
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @param array{
     *   ids?: ?array<string>,
     *   userId?: ?string,
     *   clientId?: ?string,
     *   audience?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ids = $values['ids'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->audience = $values['audience'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getIds(): ?array
    {
        return $this->ids;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIds(?array $value = null): self
    {
        $this->ids = $value;
        $this->_setField('ids');
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
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }
}
