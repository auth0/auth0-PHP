<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for the email attribute for users.
 */
class EmailAttribute extends JsonSerializableType
{
    /**
     * @var ?ConnectionAttributeIdentifier $identifier
     */
    #[JsonProperty('identifier')]
    private ?ConnectionAttributeIdentifier $identifier;

    /**
     * @var ?bool $unique Determines if the attribute is unique in a given connection
     */
    #[JsonProperty('unique')]
    private ?bool $unique;

    /**
     * @var ?bool $profileRequired Determines if property should be required for users
     */
    #[JsonProperty('profile_required')]
    private ?bool $profileRequired;

    /**
     * @var ?value-of<VerificationMethodEnum> $verificationMethod
     */
    #[JsonProperty('verification_method')]
    private ?string $verificationMethod;

    /**
     * @var ?SignupVerified $signup
     */
    #[JsonProperty('signup')]
    private ?SignupVerified $signup;

    /**
     * @param array{
     *   identifier?: ?ConnectionAttributeIdentifier,
     *   unique?: ?bool,
     *   profileRequired?: ?bool,
     *   verificationMethod?: ?value-of<VerificationMethodEnum>,
     *   signup?: ?SignupVerified,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifier = $values['identifier'] ?? null;
        $this->unique = $values['unique'] ?? null;
        $this->profileRequired = $values['profileRequired'] ?? null;
        $this->verificationMethod = $values['verificationMethod'] ?? null;
        $this->signup = $values['signup'] ?? null;
    }

    /**
     * @return ?ConnectionAttributeIdentifier
     */
    public function getIdentifier(): ?ConnectionAttributeIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param ?ConnectionAttributeIdentifier $value
     */
    public function setIdentifier(?ConnectionAttributeIdentifier $value = null): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUnique(): ?bool
    {
        return $this->unique;
    }

    /**
     * @param ?bool $value
     */
    public function setUnique(?bool $value = null): self
    {
        $this->unique = $value;
        $this->_setField('unique');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getProfileRequired(): ?bool
    {
        return $this->profileRequired;
    }

    /**
     * @param ?bool $value
     */
    public function setProfileRequired(?bool $value = null): self
    {
        $this->profileRequired = $value;
        $this->_setField('profileRequired');
        return $this;
    }

    /**
     * @return ?value-of<VerificationMethodEnum>
     */
    public function getVerificationMethod(): ?string
    {
        return $this->verificationMethod;
    }

    /**
     * @param ?value-of<VerificationMethodEnum> $value
     */
    public function setVerificationMethod(?string $value = null): self
    {
        $this->verificationMethod = $value;
        $this->_setField('verificationMethod');
        return $this;
    }

    /**
     * @return ?SignupVerified
     */
    public function getSignup(): ?SignupVerified
    {
        return $this->signup;
    }

    /**
     * @param ?SignupVerified $value
     */
    public function setSignup(?SignupVerified $value = null): self
    {
        $this->signup = $value;
        $this->_setField('signup');
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
