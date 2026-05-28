<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Identifier input display settings.
 */
class UpdateBrandingIdentifiers extends JsonSerializableType
{
    /**
     * @var ?value-of<UpdateBrandingLoginDisplayEnum> $loginDisplay
     */
    #[JsonProperty('login_display')]
    private ?string $loginDisplay;

    /**
     * @var ?bool $otpAutocomplete Whether OTP autocomplete (autocomplete="one-time-code") is enabled.
     */
    #[JsonProperty('otp_autocomplete')]
    private ?bool $otpAutocomplete;

    /**
     * @var ?UpdateBrandingPhoneDisplay $phoneDisplay
     */
    #[JsonProperty('phone_display')]
    private ?UpdateBrandingPhoneDisplay $phoneDisplay;

    /**
     * @param array{
     *   loginDisplay?: ?value-of<UpdateBrandingLoginDisplayEnum>,
     *   otpAutocomplete?: ?bool,
     *   phoneDisplay?: ?UpdateBrandingPhoneDisplay,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->loginDisplay = $values['loginDisplay'] ?? null;
        $this->otpAutocomplete = $values['otpAutocomplete'] ?? null;
        $this->phoneDisplay = $values['phoneDisplay'] ?? null;
    }

    /**
     * @return ?value-of<UpdateBrandingLoginDisplayEnum>
     */
    public function getLoginDisplay(): ?string
    {
        return $this->loginDisplay;
    }

    /**
     * @param ?value-of<UpdateBrandingLoginDisplayEnum> $value
     */
    public function setLoginDisplay(?string $value = null): self
    {
        $this->loginDisplay = $value;
        $this->_setField('loginDisplay');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getOtpAutocomplete(): ?bool
    {
        return $this->otpAutocomplete;
    }

    /**
     * @param ?bool $value
     */
    public function setOtpAutocomplete(?bool $value = null): self
    {
        $this->otpAutocomplete = $value;
        $this->_setField('otpAutocomplete');
        return $this;
    }

    /**
     * @return ?UpdateBrandingPhoneDisplay
     */
    public function getPhoneDisplay(): ?UpdateBrandingPhoneDisplay
    {
        return $this->phoneDisplay;
    }

    /**
     * @param ?UpdateBrandingPhoneDisplay $value
     */
    public function setPhoneDisplay(?UpdateBrandingPhoneDisplay $value = null): self
    {
        $this->phoneDisplay = $value;
        $this->_setField('phoneDisplay');
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
