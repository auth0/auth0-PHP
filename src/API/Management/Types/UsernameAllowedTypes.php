<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UsernameAllowedTypes extends JsonSerializableType
{
    /**
     * @var ?bool $email
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $phoneNumber
     */
    #[JsonProperty('phone_number')]
    private ?bool $phoneNumber;

    /**
     * @param array{
     *   email?: ?bool,
     *   phoneNumber?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->email = $values['email'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEmail(): ?bool
    {
        return $this->email;
    }

    /**
     * @param ?bool $value
     */
    public function setEmail(?bool $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPhoneNumber(): ?bool
    {
        return $this->phoneNumber;
    }

    /**
     * @param ?bool $value
     */
    public function setPhoneNumber(?bool $value = null): self
    {
        $this->phoneNumber = $value;
        $this->_setField('phoneNumber');
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
