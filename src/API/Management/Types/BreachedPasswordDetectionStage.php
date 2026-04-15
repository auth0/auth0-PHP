<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BreachedPasswordDetectionStage extends JsonSerializableType
{
    /**
     * @var ?BreachedPasswordDetectionPreUserRegistrationStage $preUserRegistration
     */
    #[JsonProperty('pre-user-registration')]
    private ?BreachedPasswordDetectionPreUserRegistrationStage $preUserRegistration;

    /**
     * @var ?BreachedPasswordDetectionPreChangePasswordStage $preChangePassword
     */
    #[JsonProperty('pre-change-password')]
    private ?BreachedPasswordDetectionPreChangePasswordStage $preChangePassword;

    /**
     * @param array{
     *   preUserRegistration?: ?BreachedPasswordDetectionPreUserRegistrationStage,
     *   preChangePassword?: ?BreachedPasswordDetectionPreChangePasswordStage,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->preUserRegistration = $values['preUserRegistration'] ?? null;
        $this->preChangePassword = $values['preChangePassword'] ?? null;
    }

    /**
     * @return ?BreachedPasswordDetectionPreUserRegistrationStage
     */
    public function getPreUserRegistration(): ?BreachedPasswordDetectionPreUserRegistrationStage
    {
        return $this->preUserRegistration;
    }

    /**
     * @param ?BreachedPasswordDetectionPreUserRegistrationStage $value
     */
    public function setPreUserRegistration(?BreachedPasswordDetectionPreUserRegistrationStage $value = null): self
    {
        $this->preUserRegistration = $value;
        $this->_setField('preUserRegistration');
        return $this;
    }

    /**
     * @return ?BreachedPasswordDetectionPreChangePasswordStage
     */
    public function getPreChangePassword(): ?BreachedPasswordDetectionPreChangePasswordStage
    {
        return $this->preChangePassword;
    }

    /**
     * @param ?BreachedPasswordDetectionPreChangePasswordStage $value
     */
    public function setPreChangePassword(?BreachedPasswordDetectionPreChangePasswordStage $value = null): self
    {
        $this->preChangePassword = $value;
        $this->_setField('preChangePassword');
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
