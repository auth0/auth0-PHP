<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionAuth0UpdateUserParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $userId
     */
    #[JsonProperty('user_id')]
    private string $userId;

    /**
     * @var array<string, mixed> $changes
     */
    #[JsonProperty('changes'), ArrayType(['string' => 'mixed'])]
    private array $changes;

    /**
     * @param array{
     *   connectionId: string,
     *   userId: string,
     *   changes: array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->userId = $values['userId'];
        $this->changes = $values['changes'];
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
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $value
     */
    public function setUserId(string $value): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getChanges(): array
    {
        return $this->changes;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setChanges(array $value): self
    {
        $this->changes = $value;
        $this->_setField('changes');
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
