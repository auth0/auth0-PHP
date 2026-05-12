<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Profile data for the user.
 */
class EventStreamCloudEventUserUpdatedObjectIdentitiesItemSocialProfileData extends JsonSerializableType
{
    /**
     * @var ?string $email Email address of this user.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?bool $emailVerified Whether this email address is verified (true) or unverified (false).
     */
    #[JsonProperty('email_verified')]
    private ?bool $emailVerified;

    /**
     * @var ?string $name Name of this user.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $username Username of this user.
     */
    #[JsonProperty('username')]
    private ?string $username;

    /**
     * @var ?string $givenName Given name/first name/forename of this user.
     */
    #[JsonProperty('given_name')]
    private ?string $givenName;

    /**
     * @var ?string $familyName Family name/last name/surname of this user.
     */
    #[JsonProperty('family_name')]
    private ?string $familyName;

    /**
     * @var ?string $phoneNumber Phone number of this user.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?bool $phoneVerified Whether this phone number has been verified (true) or not (false).
     */
    #[JsonProperty('phone_verified')]
    private ?bool $phoneVerified;

    /**
     * @param array{
     *   email?: ?string,
     *   emailVerified?: ?bool,
     *   name?: ?string,
     *   username?: ?string,
     *   givenName?: ?string,
     *   familyName?: ?string,
     *   phoneNumber?: ?string,
     *   phoneVerified?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->email = $values['email'] ?? null;
        $this->emailVerified = $values['emailVerified'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->username = $values['username'] ?? null;
        $this->givenName = $values['givenName'] ?? null;
        $this->familyName = $values['familyName'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->phoneVerified = $values['phoneVerified'] ?? null;
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
     * @return ?bool
     */
    public function getEmailVerified(): ?bool
    {
        return $this->emailVerified;
    }

    /**
     * @param ?bool $value
     */
    public function setEmailVerified(?bool $value = null): self
    {
        $this->emailVerified = $value;
        $this->_setField('emailVerified');
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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param ?string $value
     */
    public function setUsername(?string $value = null): self
    {
        $this->username = $value;
        $this->_setField('username');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    /**
     * @param ?string $value
     */
    public function setGivenName(?string $value = null): self
    {
        $this->givenName = $value;
        $this->_setField('givenName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    /**
     * @param ?string $value
     */
    public function setFamilyName(?string $value = null): self
    {
        $this->familyName = $value;
        $this->_setField('familyName');
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
     * @return ?bool
     */
    public function getPhoneVerified(): ?bool
    {
        return $this->phoneVerified;
    }

    /**
     * @param ?bool $value
     */
    public function setPhoneVerified(?bool $value = null): self
    {
        $this->phoneVerified = $value;
        $this->_setField('phoneVerified');
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
