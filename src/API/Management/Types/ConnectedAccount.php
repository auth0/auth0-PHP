<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class ConnectedAccount extends JsonSerializableType
{
    /**
     * @var string $id The unique identifier for the connected account.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $connection The name of the connection associated with the account.
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var string $connectionId The unique identifier of the connection associated with the account.
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $strategy The authentication strategy used by the connection.
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var value-of<ConnectedAccountAccessTypeEnum> $accessType
     */
    #[JsonProperty('access_type')]
    private string $accessType;

    /**
     * @var ?array<string> $scopes The scopes granted for this connected account.
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private ?array $scopes;

    /**
     * @var DateTime $createdAt ISO 8601 timestamp when the connected account was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var ?DateTime $expiresAt ISO 8601 timestamp when the connected account expires.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @param array{
     *   id: string,
     *   connection: string,
     *   connectionId: string,
     *   strategy: string,
     *   accessType: value-of<ConnectedAccountAccessTypeEnum>,
     *   createdAt: DateTime,
     *   scopes?: ?array<string>,
     *   expiresAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->connection = $values['connection'];
        $this->connectionId = $values['connectionId'];
        $this->strategy = $values['strategy'];
        $this->accessType = $values['accessType'];
        $this->scopes = $values['scopes'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->expiresAt = $values['expiresAt'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param string $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return value-of<ConnectedAccountAccessTypeEnum>
     */
    public function getAccessType(): string
    {
        return $this->accessType;
    }

    /**
     * @param value-of<ConnectedAccountAccessTypeEnum> $value
     */
    public function setAccessType(string $value): self
    {
        $this->accessType = $value;
        $this->_setField('accessType');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScopes(?array $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
