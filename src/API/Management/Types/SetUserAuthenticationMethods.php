<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetUserAuthenticationMethods extends JsonSerializableType
{
    /**
     * @var value-of<AuthenticationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?value-of<PreferredAuthenticationMethodEnum> $preferredAuthenticationMethod
     */
    #[JsonProperty('preferred_authentication_method')]
    private ?string $preferredAuthenticationMethod;

    /**
     * @var ?string $name AA human-readable label to identify the authentication method.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $phoneNumber Applies to phone authentication methods only. The destination phone number used to send verification codes via text and voice.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?string $email Applies to email authentication methods only. The email address used to send verification messages.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?string $totpSecret Applies to totp authentication methods only. The base32 encoded secret for TOTP generation.
     */
    #[JsonProperty('totp_secret')]
    private ?string $totpSecret;

    /**
     * @param array{
     *   type: value-of<AuthenticationTypeEnum>,
     *   preferredAuthenticationMethod?: ?value-of<PreferredAuthenticationMethodEnum>,
     *   name?: ?string,
     *   phoneNumber?: ?string,
     *   email?: ?string,
     *   totpSecret?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->preferredAuthenticationMethod = $values['preferredAuthenticationMethod'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->totpSecret = $values['totpSecret'] ?? null;
    }

    /**
     * @return value-of<AuthenticationTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<AuthenticationTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?value-of<PreferredAuthenticationMethodEnum>
     */
    public function getPreferredAuthenticationMethod(): ?string
    {
        return $this->preferredAuthenticationMethod;
    }

    /**
     * @param ?value-of<PreferredAuthenticationMethodEnum> $value
     */
    public function setPreferredAuthenticationMethod(?string $value = null): self
    {
        $this->preferredAuthenticationMethod = $value;
        $this->_setField('preferredAuthenticationMethod');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param ?string $value
     */
    public function setPhoneNumber(?string $value = null): self
    {
        $this->phoneNumber = $value;
        $this->_setField('phoneNumber');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param ?string $value
     */
    public function setEmail(?string $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTotpSecret(): ?string
    {
        return $this->totpSecret;
    }

    /**
     * @param ?string $value
     */
    public function setTotpSecret(?string $value = null): self
    {
        $this->totpSecret = $value;
        $this->_setField('totpSecret');
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
