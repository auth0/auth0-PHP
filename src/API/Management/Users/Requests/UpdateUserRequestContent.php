<?php

namespace Auth0\SDK\API\Management\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateUserRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $blocked Whether this user was blocked by an administrator (true) or not (false).
     */
    #[JsonProperty('blocked')]
    private ?bool $blocked;

    /**
     * @var ?bool $emailVerified Whether this email address is verified (true) or unverified (false). If set to false the user will not receive a verification email unless `verify_email` is set to true.
     */
    #[JsonProperty('email_verified')]
    private ?bool $emailVerified;

    /**
     * @var ?string $email Email address of this user.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?string $phoneNumber The user's phone number (following the E.164 recommendation).
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?bool $phoneVerified Whether this phone number has been verified (true) or not (false).
     */
    #[JsonProperty('phone_verified')]
    private ?bool $phoneVerified;

    /**
     * @var ?array<string, mixed> $userMetadata User metadata to which this user has read/write access.
     */
    #[JsonProperty('user_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $userMetadata;

    /**
     * @var ?array<string, mixed> $appMetadata User metadata to which this user has read-only access.
     */
    #[JsonProperty('app_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $appMetadata;

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
     * @var ?string $name Name of this user.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $nickname Preferred nickname or alias of this user.
     */
    #[JsonProperty('nickname')]
    private ?string $nickname;

    /**
     * @var ?string $picture URL to picture, photo, or avatar of this user.
     */
    #[JsonProperty('picture')]
    private ?string $picture;

    /**
     * @var ?bool $verifyEmail Whether this user will receive a verification email after creation (true) or no email (false). Overrides behavior of `email_verified` parameter.
     */
    #[JsonProperty('verify_email')]
    private ?bool $verifyEmail;

    /**
     * @var ?bool $verifyPhoneNumber Whether this user will receive a text after changing the phone number (true) or no text (false). Only valid when changing phone number for SMS connections.
     */
    #[JsonProperty('verify_phone_number')]
    private ?bool $verifyPhoneNumber;

    /**
     * @var ?string $password New password for this user. Only valid for database connections.
     */
    #[JsonProperty('password')]
    private ?string $password;

    /**
     * @var ?string $connection Name of the connection to target for this user update.
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @var ?string $clientId Auth0 client ID. Only valid when updating email address.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $username The user's username. Only valid if the connection requires a username.
     */
    #[JsonProperty('username')]
    private ?string $username;

    /**
     * @param array{
     *   blocked?: ?bool,
     *   emailVerified?: ?bool,
     *   email?: ?string,
     *   phoneNumber?: ?string,
     *   phoneVerified?: ?bool,
     *   userMetadata?: ?array<string, mixed>,
     *   appMetadata?: ?array<string, mixed>,
     *   givenName?: ?string,
     *   familyName?: ?string,
     *   name?: ?string,
     *   nickname?: ?string,
     *   picture?: ?string,
     *   verifyEmail?: ?bool,
     *   verifyPhoneNumber?: ?bool,
     *   password?: ?string,
     *   connection?: ?string,
     *   clientId?: ?string,
     *   username?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->blocked = $values['blocked'] ?? null;
        $this->emailVerified = $values['emailVerified'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->phoneVerified = $values['phoneVerified'] ?? null;
        $this->userMetadata = $values['userMetadata'] ?? null;
        $this->appMetadata = $values['appMetadata'] ?? null;
        $this->givenName = $values['givenName'] ?? null;
        $this->familyName = $values['familyName'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->nickname = $values['nickname'] ?? null;
        $this->picture = $values['picture'] ?? null;
        $this->verifyEmail = $values['verifyEmail'] ?? null;
        $this->verifyPhoneNumber = $values['verifyPhoneNumber'] ?? null;
        $this->password = $values['password'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->username = $values['username'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getBlocked(): ?bool
    {
        return $this->blocked;
    }

    /**
     * @param ?bool $value
     */
    public function setBlocked(?bool $value = null): self
    {
        $this->blocked = $value;
        $this->_setField('blocked');
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
     * @return ?array<string, mixed>
     */
    public function getUserMetadata(): ?array
    {
        return $this->userMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setUserMetadata(?array $value = null): self
    {
        $this->userMetadata = $value;
        $this->_setField('userMetadata');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getAppMetadata(): ?array
    {
        return $this->appMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setAppMetadata(?array $value = null): self
    {
        $this->appMetadata = $value;
        $this->_setField('appMetadata');
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
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param ?string $value
     */
    public function setNickname(?string $value = null): self
    {
        $this->nickname = $value;
        $this->_setField('nickname');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param ?string $value
     */
    public function setPicture(?string $value = null): self
    {
        $this->picture = $value;
        $this->_setField('picture');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getVerifyEmail(): ?bool
    {
        return $this->verifyEmail;
    }

    /**
     * @param ?bool $value
     */
    public function setVerifyEmail(?bool $value = null): self
    {
        $this->verifyEmail = $value;
        $this->_setField('verifyEmail');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getVerifyPhoneNumber(): ?bool
    {
        return $this->verifyPhoneNumber;
    }

    /**
     * @param ?bool $value
     */
    public function setVerifyPhoneNumber(?bool $value = null): self
    {
        $this->verifyPhoneNumber = $value;
        $this->_setField('verifyPhoneNumber');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param ?string $value
     */
    public function setPassword(?string $value = null): self
    {
        $this->password = $value;
        $this->_setField('password');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnection(): ?string
    {
        return $this->connection;
    }

    /**
     * @param ?string $value
     */
    public function setConnection(?string $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
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
}
