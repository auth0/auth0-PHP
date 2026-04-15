<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Attribute configuration
 */
class ConnectionAttributes extends JsonSerializableType
{
    /**
     * @var ?EmailAttribute $email
     */
    #[JsonProperty('email')]
    private ?EmailAttribute $email;

    /**
     * @var ?PhoneAttribute $phoneNumber
     */
    #[JsonProperty('phone_number')]
    private ?PhoneAttribute $phoneNumber;

    /**
     * @var ?UsernameAttribute $username
     */
    #[JsonProperty('username')]
    private ?UsernameAttribute $username;

    /**
     * @param array{
     *   email?: ?EmailAttribute,
     *   phoneNumber?: ?PhoneAttribute,
     *   username?: ?UsernameAttribute,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->email = $values['email'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->username = $values['username'] ?? null;
    }

    /**
     * @return ?EmailAttribute
     */
    public function getEmail(): ?EmailAttribute
    {
        return $this->email;
    }

    /**
     * @param ?EmailAttribute $value
     */
    public function setEmail(?EmailAttribute $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?PhoneAttribute
     */
    public function getPhoneNumber(): ?PhoneAttribute
    {
        return $this->phoneNumber;
    }

    /**
     * @param ?PhoneAttribute $value
     */
    public function setPhoneNumber(?PhoneAttribute $value = null): self
    {
        $this->phoneNumber = $value;
        $this->_setField('phoneNumber');
        return $this;
    }

    /**
     * @return ?UsernameAttribute
     */
    public function getUsername(): ?UsernameAttribute
    {
        return $this->username;
    }

    /**
     * @param ?UsernameAttribute $value
     */
    public function setUsername(?UsernameAttribute $value = null): self
    {
        $this->username = $value;
        $this->_setField('username');
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
