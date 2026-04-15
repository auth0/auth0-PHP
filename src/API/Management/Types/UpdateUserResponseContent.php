<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateUserResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $userId ID of the user which can be used when interacting with other APIs.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

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
     * @var ?string $username Username of this user.
     */
    #[JsonProperty('username')]
    private ?string $username;

    /**
     * @var ?string $phoneNumber Phone number for this user. Follows the <a href="https://en.wikipedia.org/wiki/E.164">E.164 recommendation</a>.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?bool $phoneVerified Whether this phone number has been verified (true) or not (false).
     */
    #[JsonProperty('phone_verified')]
    private ?bool $phoneVerified;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $createdAt
     */
    #[JsonProperty('created_at'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $createdAt;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $updatedAt
     */
    #[JsonProperty('updated_at'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $updatedAt;

    /**
     * @var ?array<UserIdentitySchema> $identities Array of user identity objects when accounts are linked.
     */
    #[JsonProperty('identities'), ArrayType([UserIdentitySchema::class])]
    private ?array $identities;

    /**
     * @var ?array<string, mixed> $appMetadata
     */
    #[JsonProperty('app_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $appMetadata;

    /**
     * @var ?array<string, mixed> $userMetadata
     */
    #[JsonProperty('user_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $userMetadata;

    /**
     * @var ?string $picture URL to picture, photo, or avatar of this user.
     */
    #[JsonProperty('picture')]
    private ?string $picture;

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
     * @var ?array<string> $multifactor List of multi-factor authentication providers with which this user has enrolled.
     */
    #[JsonProperty('multifactor'), ArrayType(['string'])]
    private ?array $multifactor;

    /**
     * @var ?string $lastIp Last IP address from which this user logged in.
     */
    #[JsonProperty('last_ip')]
    private ?string $lastIp;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $lastLogin
     */
    #[JsonProperty('last_login'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $lastLogin;

    /**
     * @var ?int $loginsCount Total number of logins this user has performed.
     */
    #[JsonProperty('logins_count')]
    private ?int $loginsCount;

    /**
     * @var ?bool $blocked Whether this user was blocked by an administrator (true) or is not (false).
     */
    #[JsonProperty('blocked')]
    private ?bool $blocked;

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
     * @param array{
     *   userId?: ?string,
     *   email?: ?string,
     *   emailVerified?: ?bool,
     *   username?: ?string,
     *   phoneNumber?: ?string,
     *   phoneVerified?: ?bool,
     *   createdAt?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   updatedAt?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   identities?: ?array<UserIdentitySchema>,
     *   appMetadata?: ?array<string, mixed>,
     *   userMetadata?: ?array<string, mixed>,
     *   picture?: ?string,
     *   name?: ?string,
     *   nickname?: ?string,
     *   multifactor?: ?array<string>,
     *   lastIp?: ?string,
     *   lastLogin?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   loginsCount?: ?int,
     *   blocked?: ?bool,
     *   givenName?: ?string,
     *   familyName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userId = $values['userId'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->emailVerified = $values['emailVerified'] ?? null;
        $this->username = $values['username'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->phoneVerified = $values['phoneVerified'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->identities = $values['identities'] ?? null;
        $this->appMetadata = $values['appMetadata'] ?? null;
        $this->userMetadata = $values['userMetadata'] ?? null;
        $this->picture = $values['picture'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->nickname = $values['nickname'] ?? null;
        $this->multifactor = $values['multifactor'] ?? null;
        $this->lastIp = $values['lastIp'] ?? null;
        $this->lastLogin = $values['lastLogin'] ?? null;
        $this->loginsCount = $values['loginsCount'] ?? null;
        $this->blocked = $values['blocked'] ?? null;
        $this->givenName = $values['givenName'] ?? null;
        $this->familyName = $values['familyName'] ?? null;
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
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getCreatedAt(): string|array|null
    {
        return $this->createdAt;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setCreatedAt(string|array|null $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getUpdatedAt(): string|array|null
    {
        return $this->updatedAt;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setUpdatedAt(string|array|null $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?array<UserIdentitySchema>
     */
    public function getIdentities(): ?array
    {
        return $this->identities;
    }

    /**
     * @param ?array<UserIdentitySchema> $value
     */
    public function setIdentities(?array $value = null): self
    {
        $this->identities = $value;
        $this->_setField('identities');
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
     * @return ?array<string>
     */
    public function getMultifactor(): ?array
    {
        return $this->multifactor;
    }

    /**
     * @param ?array<string> $value
     */
    public function setMultifactor(?array $value = null): self
    {
        $this->multifactor = $value;
        $this->_setField('multifactor');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastIp(): ?string
    {
        return $this->lastIp;
    }

    /**
     * @param ?string $value
     */
    public function setLastIp(?string $value = null): self
    {
        $this->lastIp = $value;
        $this->_setField('lastIp');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getLastLogin(): string|array|null
    {
        return $this->lastLogin;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setLastLogin(string|array|null $value = null): self
    {
        $this->lastLogin = $value;
        $this->_setField('lastLogin');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLoginsCount(): ?int
    {
        return $this->loginsCount;
    }

    /**
     * @param ?int $value
     */
    public function setLoginsCount(?int $value = null): self
    {
        $this->loginsCount = $value;
        $this->_setField('loginsCount');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
