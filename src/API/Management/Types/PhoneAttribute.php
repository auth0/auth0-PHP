<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for the phone number attribute for users.
 */
class PhoneAttribute extends JsonSerializableType
{
    /**
     * @var ?ConnectionAttributeIdentifier $identifier
     */
    #[JsonProperty('identifier')]
    private ?ConnectionAttributeIdentifier $identifier;

    /**
     * @var ?bool $profileRequired Determines if property should be required for users
     */
    #[JsonProperty('profile_required')]
    private ?bool $profileRequired;

    /**
     * @var ?SignupVerified $signup
     */
    #[JsonProperty('signup')]
    private ?SignupVerified $signup;

    /**
     * @param array{
     *   identifier?: ?ConnectionAttributeIdentifier,
     *   profileRequired?: ?bool,
     *   signup?: ?SignupVerified,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifier = $values['identifier'] ?? null;
        $this->profileRequired = $values['profileRequired'] ?? null;
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
