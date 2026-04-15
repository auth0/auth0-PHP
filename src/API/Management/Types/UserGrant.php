<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UserGrant extends JsonSerializableType
{
    /**
     * @var ?string $id ID of the grant.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $clientId ID of the client.
     */
    #[JsonProperty('clientID')]
    private ?string $clientId;

    /**
     * @var ?string $userId ID of the user.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?string $audience Audience of the grant.
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?array<string> $scope Scopes included in this grant.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @param array{
     *   id?: ?string,
     *   clientId?: ?string,
     *   userId?: ?string,
     *   audience?: ?string,
     *   scope?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->scope = $values['scope'] ?? null;
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

    /**
     * @return ?array<string>
     */
    public function getScope(): ?array
    {
        return $this->scope;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScope(?array $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
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
