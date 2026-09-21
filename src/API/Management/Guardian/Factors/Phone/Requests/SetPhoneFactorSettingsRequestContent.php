<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetPhoneFactorSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var int $otpLength The length of the OTP code.
     */
    #[JsonProperty('otp_length')]
    private int $otpLength;

    /**
     * @var int $otpExpirationTime The OTP expiration time in seconds.
     */
    #[JsonProperty('otp_expiration_time')]
    private int $otpExpirationTime;

    /**
     * @param array{
     *   otpLength: int,
     *   otpExpirationTime: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->otpLength = $values['otpLength'];
        $this->otpExpirationTime = $values['otpExpirationTime'];
    }

    /**
     * @return int
     */
    public function getOtpLength(): int
    {
        return $this->otpLength;
    }

    /**
     * @param int $value
     */
    public function setOtpLength(int $value): self
    {
        $this->otpLength = $value;
        $this->_setField('otpLength');
        return $this;
    }

    /**
     * @return int
     */
    public function getOtpExpirationTime(): int
    {
        return $this->otpExpirationTime;
    }

    /**
     * @param int $value
     */
    public function setOtpExpirationTime(int $value): self
    {
        $this->otpExpirationTime = $value;
        $this->_setField('otpExpirationTime');
        return $this;
    }
}
