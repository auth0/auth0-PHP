<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class BrandingThemeIdentifiers extends JsonSerializableType
{
    /**
     * @var value-of<BrandingThemeIdentifiersLoginDisplayEnum> $loginDisplay
     */
    #[JsonProperty('login_display')]
    private string $loginDisplay;

    /**
     * @var bool $otpAutocomplete OTP autocomplete
     */
    #[JsonProperty('otp_autocomplete')]
    private bool $otpAutocomplete;

    /**
     * @var BrandingThemeIdentifiersPhoneDisplay $phoneDisplay
     */
    #[JsonProperty('phone_display')]
    private BrandingThemeIdentifiersPhoneDisplay $phoneDisplay;

    /**
     * @param array{
     *   loginDisplay: value-of<BrandingThemeIdentifiersLoginDisplayEnum>,
     *   otpAutocomplete: bool,
     *   phoneDisplay: BrandingThemeIdentifiersPhoneDisplay,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->loginDisplay = $values['loginDisplay'];
        $this->otpAutocomplete = $values['otpAutocomplete'];
        $this->phoneDisplay = $values['phoneDisplay'];
    }

    /**
     * @return value-of<BrandingThemeIdentifiersLoginDisplayEnum>
     */
    public function getLoginDisplay(): string
    {
        return $this->loginDisplay;
    }

    /**
     * @param value-of<BrandingThemeIdentifiersLoginDisplayEnum> $value
     */
    public function setLoginDisplay(string $value): self
    {
        $this->loginDisplay = $value;
        $this->_setField('loginDisplay');
        return $this;
    }

    /**
     * @return bool
     */
    public function getOtpAutocomplete(): bool
    {
        return $this->otpAutocomplete;
    }

    /**
     * @param bool $value
     */
    public function setOtpAutocomplete(bool $value): self
    {
        $this->otpAutocomplete = $value;
        $this->_setField('otpAutocomplete');
        return $this;
    }

    /**
     * @return BrandingThemeIdentifiersPhoneDisplay
     */
    public function getPhoneDisplay(): BrandingThemeIdentifiersPhoneDisplay
    {
        return $this->phoneDisplay;
    }

    /**
     * @param BrandingThemeIdentifiersPhoneDisplay $value
     */
    public function setPhoneDisplay(BrandingThemeIdentifiersPhoneDisplay $value): self
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
