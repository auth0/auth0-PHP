<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Holds per-stage configuration options (max_attempts and rate).
 */
class SuspiciousIpThrottlingStage extends JsonSerializableType
{
    /**
     * @var ?SuspiciousIpThrottlingPreLoginStage $preLogin
     */
    #[JsonProperty('pre-login')]
    private ?SuspiciousIpThrottlingPreLoginStage $preLogin;

    /**
     * @var ?SuspiciousIpThrottlingPreUserRegistrationStage $preUserRegistration
     */
    #[JsonProperty('pre-user-registration')]
    private ?SuspiciousIpThrottlingPreUserRegistrationStage $preUserRegistration;

    /**
     * @param array{
     *   preLogin?: ?SuspiciousIpThrottlingPreLoginStage,
     *   preUserRegistration?: ?SuspiciousIpThrottlingPreUserRegistrationStage,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->preLogin = $values['preLogin'] ?? null;
        $this->preUserRegistration = $values['preUserRegistration'] ?? null;
    }

    /**
     * @return ?SuspiciousIpThrottlingPreLoginStage
     */
    public function getPreLogin(): ?SuspiciousIpThrottlingPreLoginStage
    {
        return $this->preLogin;
    }

    /**
     * @param ?SuspiciousIpThrottlingPreLoginStage $value
     */
    public function setPreLogin(?SuspiciousIpThrottlingPreLoginStage $value = null): self
    {
        $this->preLogin = $value;
        $this->_setField('preLogin');
        return $this;
    }

    /**
     * @return ?SuspiciousIpThrottlingPreUserRegistrationStage
     */
    public function getPreUserRegistration(): ?SuspiciousIpThrottlingPreUserRegistrationStage
    {
        return $this->preUserRegistration;
    }

    /**
     * @param ?SuspiciousIpThrottlingPreUserRegistrationStage $value
     */
    public function setPreUserRegistration(?SuspiciousIpThrottlingPreUserRegistrationStage $value = null): self
    {
        $this->preUserRegistration = $value;
        $this->_setField('preUserRegistration');
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
