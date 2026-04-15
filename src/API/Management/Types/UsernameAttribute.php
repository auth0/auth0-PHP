<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for the username attribute for users.
 */
class UsernameAttribute extends JsonSerializableType
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
     * @var ?SignupSchema $signup
     */
    #[JsonProperty('signup')]
    private ?SignupSchema $signup;

    /**
     * @var ?UsernameValidation $validation
     */
    #[JsonProperty('validation')]
    private ?UsernameValidation $validation;

    /**
     * @param array{
     *   identifier?: ?ConnectionAttributeIdentifier,
     *   profileRequired?: ?bool,
     *   signup?: ?SignupSchema,
     *   validation?: ?UsernameValidation,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->identifier = $values['identifier'] ?? null;
        $this->profileRequired = $values['profileRequired'] ?? null;
        $this->signup = $values['signup'] ?? null;
        $this->validation = $values['validation'] ?? null;
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
     * @return ?SignupSchema
     */
    public function getSignup(): ?SignupSchema
    {
        return $this->signup;
    }

    /**
     * @param ?SignupSchema $value
     */
    public function setSignup(?SignupSchema $value = null): self
    {
        $this->signup = $value;
        $this->_setField('signup');
        return $this;
    }

    /**
     * @return ?UsernameValidation
     */
    public function getValidation(): ?UsernameValidation
    {
        return $this->validation;
    }

    /**
     * @param ?UsernameValidation $value
     */
    public function setValidation(?UsernameValidation $value = null): self
    {
        $this->validation = $value;
        $this->_setField('validation');
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
