<?php

namespace Auth0\SDK\API\Management\Keys\Encryption\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\CreateEncryptionKeyType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateEncryptionKeyRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<CreateEncryptionKeyType> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @param array{
     *   type: value-of<CreateEncryptionKeyType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
    }

    /**
     * @return value-of<CreateEncryptionKeyType>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<CreateEncryptionKeyType> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }
}
