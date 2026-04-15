<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionAuth0GetUserParams extends JsonSerializableType
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
     * @param array{
     *   connectionId: string,
     *   userId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->userId = $values['userId'];
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
