<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UserBlockIdentifier extends JsonSerializableType
{
    /**
     * @var ?string $identifier Identifier (should be any of an `email`, `username`, or `phone_number`)
     */
    #[JsonProperty('identifier')]
    private ?string $identifier;

    /**
     * @var ?string $ip IP Address
     */
    #[JsonProperty('ip')]
    private ?string $ip;

    /**
     * @var ?string $connection Connection identifier
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @param array{
     *   identifier?: ?string,
     *   ip?: ?string,
     *   connection?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifier = $values['identifier'] ?? null;
        $this->ip = $values['ip'] ?? null;
        $this->connection = $values['connection'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param ?string $value
     */
    public function setIdentifier(?string $value = null): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param ?string $value
     */
    public function setIp(?string $value = null): self
    {
        $this->ip = $value;
        $this->_setField('ip');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
