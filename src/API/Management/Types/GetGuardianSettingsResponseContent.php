<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetGuardianSettingsResponseContent extends JsonSerializableType
{
    /**
     * @var bool $displayRememberMeCheckbox Determines whether to display the "Remember Me" checkbox on the MFA prompt in Universal Login.
     */
    #[JsonProperty('display_remember_me_checkbox')]
    private bool $displayRememberMeCheckbox;

    /**
     * @var bool $rememberMeDefaultValue Determines the default state of the "Remember Me" checkbox on the MFA prompt in Universal Login.
     */
    #[JsonProperty('remember_me_default_value')]
    private bool $rememberMeDefaultValue;

    /**
     * @var int $mfaSessionInactivityTimeout Duration of inactivity after which the user will be prompted for MFA. Represented as seconds. Minimum duration is 1 hour, maximum is 30 days, and cannot exceed the overall timeout.
     */
    #[JsonProperty('mfa_session_inactivity_timeout')]
    private int $mfaSessionInactivityTimeout;

    /**
     * @var int $mfaSessionOverallTimeout Maximum duration after which the user will be prompted for MFA regardless of activity. Represented as seconds. Minimum duration is 1 hour, maximum is 90 days.
     */
    #[JsonProperty('mfa_session_overall_timeout')]
    private int $mfaSessionOverallTimeout;

    /**
     * @param array{
     *   displayRememberMeCheckbox: bool,
     *   rememberMeDefaultValue: bool,
     *   mfaSessionInactivityTimeout: int,
     *   mfaSessionOverallTimeout: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->displayRememberMeCheckbox = $values['displayRememberMeCheckbox'];
        $this->rememberMeDefaultValue = $values['rememberMeDefaultValue'];
        $this->mfaSessionInactivityTimeout = $values['mfaSessionInactivityTimeout'];
        $this->mfaSessionOverallTimeout = $values['mfaSessionOverallTimeout'];
    }

    /**
     * @return bool
     */
    public function getDisplayRememberMeCheckbox(): bool
    {
        return $this->displayRememberMeCheckbox;
    }

    /**
     * @param bool $value
     */
    public function setDisplayRememberMeCheckbox(bool $value): self
    {
        $this->displayRememberMeCheckbox = $value;
        $this->_setField('displayRememberMeCheckbox');
        return $this;
    }

    /**
     * @return bool
     */
    public function getRememberMeDefaultValue(): bool
    {
        return $this->rememberMeDefaultValue;
    }

    /**
     * @param bool $value
     */
    public function setRememberMeDefaultValue(bool $value): self
    {
        $this->rememberMeDefaultValue = $value;
        $this->_setField('rememberMeDefaultValue');
        return $this;
    }

    /**
     * @return int
     */
    public function getMfaSessionInactivityTimeout(): int
    {
        return $this->mfaSessionInactivityTimeout;
    }

    /**
     * @param int $value
     */
    public function setMfaSessionInactivityTimeout(int $value): self
    {
        $this->mfaSessionInactivityTimeout = $value;
        $this->_setField('mfaSessionInactivityTimeout');
        return $this;
    }

    /**
     * @return int
     */
    public function getMfaSessionOverallTimeout(): int
    {
        return $this->mfaSessionOverallTimeout;
    }

    /**
     * @param int $value
     */
    public function setMfaSessionOverallTimeout(int $value): self
    {
        $this->mfaSessionOverallTimeout = $value;
        $this->_setField('mfaSessionOverallTimeout');
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
