<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class BreachedPasswordDetectionPreUserRegistrationStage extends JsonSerializableType
{
    /**
     * Action to take when a breached password is detected during a signup.
     *               Possible values: <code>block</code>, <code>admin_notification</code>.
     *
     * @var ?array<value-of<BreachedPasswordDetectionPreUserRegistrationShieldsEnum>> $shields
     */
    #[JsonProperty('shields'), ArrayType(['string'])]
    private ?array $shields;

    /**
     * @param array{
     *   shields?: ?array<value-of<BreachedPasswordDetectionPreUserRegistrationShieldsEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->shields = $values['shields'] ?? null;
    }

    /**
     * @return ?array<value-of<BreachedPasswordDetectionPreUserRegistrationShieldsEnum>>
     */
    public function getShields(): ?array
    {
        return $this->shields;
    }

    /**
     * @param ?array<value-of<BreachedPasswordDetectionPreUserRegistrationShieldsEnum>> $value
     */
    public function setShields(?array $value = null): self
    {
        $this->shields = $value;
        $this->_setField('shields');
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
