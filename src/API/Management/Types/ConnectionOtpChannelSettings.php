<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * OTP settings for a delivery channel.
 */
class ConnectionOtpChannelSettings extends JsonSerializableType
{
    /**
     * @var ?int $otpLength Number of digits in the generated one-time password.
     */
    #[JsonProperty('otp_length')]
    private ?int $otpLength;

    /**
     * @var ?int $otpExpiry Number of seconds before the one-time password expires.
     */
    #[JsonProperty('otp_expiry')]
    private ?int $otpExpiry;

    /**
     * @param array{
     *   otpLength?: ?int,
     *   otpExpiry?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->otpLength = $values['otpLength'] ?? null;
        $this->otpExpiry = $values['otpExpiry'] ?? null;
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
    public function getOtpExpiry(): ?int
    {
        return $this->otpExpiry;
    }

    /**
     * @param ?int $value
     */
    public function setOtpExpiry(?int $value = null): self
    {
        $this->otpExpiry = $value;
        $this->_setField('otpExpiry');
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
