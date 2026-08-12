<?php

namespace Auth0\SDK\API\Management\Connections\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class DeleteConnectionUsersByEmailQueryParameters extends JsonSerializableType
{
    /**
     * @var string $email The email of the user to delete
     */
    private string $email;

    /**
     * @param array{
     *   email: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->email = $values['email'];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }
}
