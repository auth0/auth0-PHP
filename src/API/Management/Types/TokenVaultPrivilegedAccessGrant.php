<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class TokenVaultPrivilegedAccessGrant extends JsonSerializableType
{
    /**
     * @var string $connection
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var array<string> $scopes
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private array $scopes;

    /**
     * @param array{
     *   connection: string,
     *   scopes: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connection = $values['connection'];
        $this->scopes = $values['scopes'];
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
     * @return array<string>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param array<string> $value
     */
    public function setScopes(array $value): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
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
