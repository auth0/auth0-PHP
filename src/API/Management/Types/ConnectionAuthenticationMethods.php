<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for enabling authentication methods.
 */
class ConnectionAuthenticationMethods extends JsonSerializableType
{
    /**
     * @var ?ConnectionPasswordAuthenticationMethod $password
     */
    #[JsonProperty('password')]
    private ?ConnectionPasswordAuthenticationMethod $password;

    /**
     * @var ?ConnectionPasskeyAuthenticationMethod $passkey
     */
    #[JsonProperty('passkey')]
    private ?ConnectionPasskeyAuthenticationMethod $passkey;

    /**
     * @var ?ConnectionEmailOtpAuthenticationMethod $emailOtp
     */
    #[JsonProperty('email_otp')]
    private ?ConnectionEmailOtpAuthenticationMethod $emailOtp;

    /**
     * @var ?ConnectionPhoneOtpAuthenticationMethod $phoneOtp
     */
    #[JsonProperty('phone_otp')]
    private ?ConnectionPhoneOtpAuthenticationMethod $phoneOtp;

    /**
     * @param array{
     *   password?: ?ConnectionPasswordAuthenticationMethod,
     *   passkey?: ?ConnectionPasskeyAuthenticationMethod,
     *   emailOtp?: ?ConnectionEmailOtpAuthenticationMethod,
     *   phoneOtp?: ?ConnectionPhoneOtpAuthenticationMethod,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->password = $values['password'] ?? null;
        $this->passkey = $values['passkey'] ?? null;
        $this->emailOtp = $values['emailOtp'] ?? null;
        $this->phoneOtp = $values['phoneOtp'] ?? null;
    }

    /**
     * @return ?ConnectionPasswordAuthenticationMethod
     */
    public function getPassword(): ?ConnectionPasswordAuthenticationMethod
    {
        return $this->password;
    }

    /**
     * @param ?ConnectionPasswordAuthenticationMethod $value
     */
    public function setPassword(?ConnectionPasswordAuthenticationMethod $value = null): self
    {
        $this->password = $value;
        $this->_setField('password');
        return $this;
    }

    /**
     * @return ?ConnectionPasskeyAuthenticationMethod
     */
    public function getPasskey(): ?ConnectionPasskeyAuthenticationMethod
    {
        return $this->passkey;
    }

    /**
     * @param ?ConnectionPasskeyAuthenticationMethod $value
     */
    public function setPasskey(?ConnectionPasskeyAuthenticationMethod $value = null): self
    {
        $this->passkey = $value;
        $this->_setField('passkey');
        return $this;
    }

    /**
     * @return ?ConnectionEmailOtpAuthenticationMethod
     */
    public function getEmailOtp(): ?ConnectionEmailOtpAuthenticationMethod
    {
        return $this->emailOtp;
    }

    /**
     * @param ?ConnectionEmailOtpAuthenticationMethod $value
     */
    public function setEmailOtp(?ConnectionEmailOtpAuthenticationMethod $value = null): self
    {
        $this->emailOtp = $value;
        $this->_setField('emailOtp');
        return $this;
    }

    /**
     * @return ?ConnectionPhoneOtpAuthenticationMethod
     */
    public function getPhoneOtp(): ?ConnectionPhoneOtpAuthenticationMethod
    {
        return $this->phoneOtp;
    }

    /**
     * @param ?ConnectionPhoneOtpAuthenticationMethod $value
     */
    public function setPhoneOtp(?ConnectionPhoneOtpAuthenticationMethod $value = null): self
    {
        $this->phoneOtp = $value;
        $this->_setField('phoneOtp');
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
