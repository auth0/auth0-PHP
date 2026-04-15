<?php

namespace Auth0\SDK\API\Management\Users\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateUserRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $email The user's email.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?string $phoneNumber The user's phone number (following the E.164 recommendation).
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?array<string, mixed> $userMetadata
     */
    #[JsonProperty('user_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $userMetadata;

    /**
     * @var ?bool $blocked Whether this user was blocked by an administrator (true) or not (false).
     */
    #[JsonProperty('blocked')]
    private ?bool $blocked;

    /**
     * @var ?bool $emailVerified Whether this email address is verified (true) or unverified (false). User will receive a verification email after creation if `email_verified` is false or not specified
     */
    #[JsonProperty('email_verified')]
    private ?bool $emailVerified;

    /**
     * @var ?bool $phoneVerified Whether this phone number has been verified (true) or not (false).
     */
    #[JsonProperty('phone_verified')]
    private ?bool $phoneVerified;

    /**
     * @var ?array<string, mixed> $appMetadata
     */
    #[JsonProperty('app_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $appMetadata;

    /**
     * @var ?string $givenName The user's given name(s).
     */
    #[JsonProperty('given_name')]
    private ?string $givenName;

    /**
     * @var ?string $familyName The user's family name(s).
     */
    #[JsonProperty('family_name')]
    private ?string $familyName;

    /**
     * @var ?string $name The user's full name.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $nickname The user's nickname.
     */
    #[JsonProperty('nickname')]
    private ?string $nickname;

    /**
     * @var ?string $picture A URI pointing to the user's picture.
     */
    #[JsonProperty('picture')]
    private ?string $picture;

    /**
     * @var ?string $userId The external user's id provided by the identity provider.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var string $connection Name of the connection this user should be created in.
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var ?string $password Initial password for this user. Only valid for auth0 connection strategy.
     */
    #[JsonProperty('password')]
    private ?string $password;

    /**
     * @var ?bool $verifyEmail Whether the user will receive a verification email after creation (true) or no email (false). Overrides behavior of `email_verified` parameter.
     */
    #[JsonProperty('verify_email')]
    private ?bool $verifyEmail;

    /**
     * @var ?string $username The user's username. Only valid if the connection requires a username.
     */
    #[JsonProperty('username')]
    private ?string $username;

    /**
     * @param array{
     *   connection: string,
     *   email?: ?string,
     *   phoneNumber?: ?string,
     *   userMetadata?: ?array<string, mixed>,
     *   blocked?: ?bool,
     *   emailVerified?: ?bool,
     *   phoneVerified?: ?bool,
     *   appMetadata?: ?array<string, mixed>,
     *   givenName?: ?string,
     *   familyName?: ?string,
     *   name?: ?string,
     *   nickname?: ?string,
     *   picture?: ?string,
     *   userId?: ?string,
     *   password?: ?string,
     *   verifyEmail?: ?bool,
     *   username?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->email = $values['email'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->userMetadata = $values['userMetadata'] ?? null;
        $this->blocked = $values['blocked'] ?? null;
        $this->emailVerified = $values['emailVerified'] ?? null;
        $this->phoneVerified = $values['phoneVerified'] ?? null;
        $this->appMetadata = $values['appMetadata'] ?? null;
        $this->givenName = $values['givenName'] ?? null;
        $this->familyName = $values['familyName'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->nickname = $values['nickname'] ?? null;
        $this->picture = $values['picture'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->connection = $values['connection'];
        $this->password = $values['password'] ?? null;
        $this->verifyEmail = $values['verifyEmail'] ?? null;
        $this->username = $values['username'] ?? null;
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
     * @return ?string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param ?string $value
     */
    public function setUserId(?string $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return string
     */
    public function getConnection(): string
    {
        return $this->connection;
    }

    /**
     * @param string $value
     */
    public function setConnection(string $value): self
    {
        $this->connection = $value;
        $this->_setField('connection');
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
