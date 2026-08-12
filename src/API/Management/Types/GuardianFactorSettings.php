<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Factor-specific settings. Only returned when include_settings=true.
 */
class GuardianFactorSettings extends JsonSerializableType
{
    /**
     * @var ?int $otpLength The length of the OTP code.
     */
    #[JsonProperty('otp_length')]
    private ?int $otpLength;

    /**
     * @var ?int $otpExpirationTime The OTP expiration time in seconds.
     */
    #[JsonProperty('otp_expiration_time')]
    private ?int $otpExpirationTime;

    /**
     * @param array{
     *   otpLength?: ?int,
     *   otpExpirationTime?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->otpLength = $values['otpLength'] ?? null;
        $this->otpExpirationTime = $values['otpExpirationTime'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getOtpLength(): ?int
    {
        return $this->otpLength;
    }

    /**
     * @param ?int $value
     */
    public function setOtpLength(?int $value = null): self
    {
        $this->otpLength = $value;
        $this->_setField('otpLength');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getOtpExpirationTime(): ?int
    {
        return $this->otpExpirationTime;
    }

    /**
     * @param ?int $value
     */
    public function setOtpExpirationTime(?int $value = null): self
    {
        $this->otpExpirationTime = $value;
        $this->_setField('otpExpirationTime');
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
