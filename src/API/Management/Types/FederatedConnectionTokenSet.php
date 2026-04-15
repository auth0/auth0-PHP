<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class FederatedConnectionTokenSet extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $connection
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @var ?string $scope
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?DateTime $expiresAt
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @var ?DateTime $issuedAt
     */
    #[JsonProperty('issued_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $issuedAt;

    /**
     * @var ?DateTime $lastUsedAt
     */
    #[JsonProperty('last_used_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $lastUsedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   connection?: ?string,
     *   scope?: ?string,
     *   expiresAt?: ?DateTime,
     *   issuedAt?: ?DateTime,
     *   lastUsedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->issuedAt = $values['issuedAt'] ?? null;
        $this->lastUsedAt = $values['lastUsedAt'] ?? null;
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
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpiresAt(?DateTime $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getIssuedAt(): ?DateTime
    {
        return $this->issuedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setIssuedAt(?DateTime $value = null): self
    {
        $this->issuedAt = $value;
        $this->_setField('issuedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getLastUsedAt(): ?DateTime
    {
        return $this->lastUsedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setLastUsedAt(?DateTime $value = null): self
    {
        $this->lastUsedAt = $value;
        $this->_setField('lastUsedAt');
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
