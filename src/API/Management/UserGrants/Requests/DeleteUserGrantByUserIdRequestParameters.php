<?php

namespace Auth0\SDK\API\Management\UserGrants\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class DeleteUserGrantByUserIdRequestParameters extends JsonSerializableType
{
    /**
     * @var string $userId user_id of the grant to delete.
     */
    private string $userId;

    /**
     * @param array{
     *   userId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
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
}
