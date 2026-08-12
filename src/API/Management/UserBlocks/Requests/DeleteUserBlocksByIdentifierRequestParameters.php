<?php

namespace Auth0\SDK\API\Management\UserBlocks\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class DeleteUserBlocksByIdentifierRequestParameters extends JsonSerializableType
{
    /**
     * @var string $identifier Should be any of a username, phone number, or email.
     */
    private string $identifier;

    /**
     * @param array{
     *   identifier: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->identifier = $values['identifier'];
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $value
     */
    public function setIdentifier(string $value): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }
}
