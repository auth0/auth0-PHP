<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class BreachedPasswordDetectionPreChangePasswordStage extends JsonSerializableType
{
    /**
     * Action to take when a breached password is detected during a password reset.
     *               Possible values: <code>block</code>, <code>admin_notification</code>.
     *
     * @var ?array<value-of<BreachedPasswordDetectionPreChangePasswordShieldsEnum>> $shields
     */
    #[JsonProperty('shields'), ArrayType(['string'])]
    private ?array $shields;

    /**
     * @param array{
     *   shields?: ?array<value-of<BreachedPasswordDetectionPreChangePasswordShieldsEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->shields = $values['shields'] ?? null;
    }

    /**
     * @return ?array<value-of<BreachedPasswordDetectionPreChangePasswordShieldsEnum>>
     */
    public function getShields(): ?array
    {
        return $this->shields;
    }

    /**
     * @param ?array<value-of<BreachedPasswordDetectionPreChangePasswordShieldsEnum>> $value
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
