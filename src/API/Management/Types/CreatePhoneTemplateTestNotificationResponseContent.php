<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreatePhoneTemplateTestNotificationResponseContent extends JsonSerializableType
{
    /**
     * @var string $message
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @param array{
     *   message: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $value
     */
    public function setMessage(string $value): self
    {
        $this->message = $value;
        $this->_setField('message');
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
