<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class GetUserAuthenticationMethodResponseContent extends JsonSerializableType
{
    /**
     * @var string $id The ID of the authentication method (auto generated)
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var value-of<AuthenticationMethodTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?bool $confirmed The authentication method status
     */
    #[JsonProperty('confirmed')]
    private ?bool $confirmed;

    /**
     * @var ?string $name A human-readable label to identify the authentication method
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?array<UserAuthenticationMethodProperties> $authenticationMethods
     */
    #[JsonProperty('authentication_methods'), ArrayType([UserAuthenticationMethodProperties::class])]
    private ?array $authenticationMethods;

    /**
     * @var ?value-of<PreferredAuthenticationMethodEnum> $preferredAuthenticationMethod
     */
    #[JsonProperty('preferred_authentication_method')]
    private ?string $preferredAuthenticationMethod;

    /**
     * @var ?string $linkId The ID of a linked authentication method. Linked authentication methods will be deleted together.
     */
    #[JsonProperty('link_id')]
    private ?string $linkId;

    /**
     * @var ?string $phoneNumber Applies to phone authentication methods only. The destination phone number used to send verification codes via text and voice.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?string $email Applies to email and email-verification authentication methods only. The email address used to send verification messages.
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?string $keyId Applies to webauthn authentication methods only. The ID of the generated credential.
     */
    #[JsonProperty('key_id')]
    private ?string $keyId;

    /**
     * @var ?string $publicKey Applies to webauthn authentication methods only. The public key.
     */
    #[JsonProperty('public_key')]
    private ?string $publicKey;

    /**
     * @var DateTime $createdAt Authenticator creation date
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var ?DateTime $enrolledAt Enrollment date
     */
    #[JsonProperty('enrolled_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $enrolledAt;

    /**
     * @var ?DateTime $lastAuthAt Last authentication
     */
    #[JsonProperty('last_auth_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $lastAuthAt;

    /**
     * @var ?string $credentialDeviceType Applies to passkeys only. The kind of device the credential is stored on as defined by backup eligibility. "single_device" credentials cannot be backed up and synced to another device, "multi_device" credentials can be backed up if enabled by the end-user.
     */
    #[JsonProperty('credential_device_type')]
    private ?string $credentialDeviceType;

    /**
     * @var ?bool $credentialBackedUp Applies to passkeys only. Whether the credential was backed up.
     */
    #[JsonProperty('credential_backed_up')]
    private ?bool $credentialBackedUp;

    /**
     * @var ?string $identityUserId Applies to passkeys only. The ID of the user identity linked with the authentication method.
     */
    #[JsonProperty('identity_user_id')]
    private ?string $identityUserId;

    /**
     * @var ?string $userAgent Applies to passkeys only. The user-agent of the browser used to create the passkey.
     */
    #[JsonProperty('user_agent')]
    private ?string $userAgent;

    /**
     * @var ?string $aaguid Applies to passkey authentication methods only. Authenticator Attestation Globally Unique Identifier.
     */
    #[JsonProperty('aaguid')]
    private ?string $aaguid;

    /**
     * @var ?string $relyingPartyIdentifier Applies to webauthn/passkey authentication methods only. The credential's relying party identifier.
     */
    #[JsonProperty('relying_party_identifier')]
    private ?string $relyingPartyIdentifier;

    /**
     * @param array{
     *   id: string,
     *   type: value-of<AuthenticationMethodTypeEnum>,
     *   createdAt: DateTime,
     *   confirmed?: ?bool,
     *   name?: ?string,
     *   authenticationMethods?: ?array<UserAuthenticationMethodProperties>,
     *   preferredAuthenticationMethod?: ?value-of<PreferredAuthenticationMethodEnum>,
     *   linkId?: ?string,
     *   phoneNumber?: ?string,
     *   email?: ?string,
     *   keyId?: ?string,
     *   publicKey?: ?string,
     *   enrolledAt?: ?DateTime,
     *   lastAuthAt?: ?DateTime,
     *   credentialDeviceType?: ?string,
     *   credentialBackedUp?: ?bool,
     *   identityUserId?: ?string,
     *   userAgent?: ?string,
     *   aaguid?: ?string,
     *   relyingPartyIdentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->type = $values['type'];
        $this->confirmed = $values['confirmed'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->authenticationMethods = $values['authenticationMethods'] ?? null;
        $this->preferredAuthenticationMethod = $values['preferredAuthenticationMethod'] ?? null;
        $this->linkId = $values['linkId'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->keyId = $values['keyId'] ?? null;
        $this->publicKey = $values['publicKey'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->enrolledAt = $values['enrolledAt'] ?? null;
        $this->lastAuthAt = $values['lastAuthAt'] ?? null;
        $this->credentialDeviceType = $values['credentialDeviceType'] ?? null;
        $this->credentialBackedUp = $values['credentialBackedUp'] ?? null;
        $this->identityUserId = $values['identityUserId'] ?? null;
        $this->userAgent = $values['userAgent'] ?? null;
        $this->aaguid = $values['aaguid'] ?? null;
        $this->relyingPartyIdentifier = $values['relyingPartyIdentifier'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return value-of<AuthenticationMethodTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<AuthenticationMethodTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    /**
     * @param ?bool $value
     */
    public function setConfirmed(?bool $value = null): self
    {
        $this->confirmed = $value;
        $this->_setField('confirmed');
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
     * @return ?array<UserAuthenticationMethodProperties>
     */
    public function getAuthenticationMethods(): ?array
    {
        return $this->authenticationMethods;
    }

    /**
     * @param ?array<UserAuthenticationMethodProperties> $value
     */
    public function setAuthenticationMethods(?array $value = null): self
    {
        $this->authenticationMethods = $value;
        $this->_setField('authenticationMethods');
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
    public function getLinkId(): ?string
    {
        return $this->linkId;
    }

    /**
     * @param ?string $value
     */
    public function setLinkId(?string $value = null): self
    {
        $this->linkId = $value;
        $this->_setField('linkId');
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
    public function getKeyId(): ?string
    {
        return $this->keyId;
    }

    /**
     * @param ?string $value
     */
    public function setKeyId(?string $value = null): self
    {
        $this->keyId = $value;
        $this->_setField('keyId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPublicKey(): ?string
    {
        return $this->publicKey;
    }

    /**
     * @param ?string $value
     */
    public function setPublicKey(?string $value = null): self
    {
        $this->publicKey = $value;
        $this->_setField('publicKey');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getEnrolledAt(): ?DateTime
    {
        return $this->enrolledAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setEnrolledAt(?DateTime $value = null): self
    {
        $this->enrolledAt = $value;
        $this->_setField('enrolledAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getLastAuthAt(): ?DateTime
    {
        return $this->lastAuthAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setLastAuthAt(?DateTime $value = null): self
    {
        $this->lastAuthAt = $value;
        $this->_setField('lastAuthAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCredentialDeviceType(): ?string
    {
        return $this->credentialDeviceType;
    }

    /**
     * @param ?string $value
     */
    public function setCredentialDeviceType(?string $value = null): self
    {
        $this->credentialDeviceType = $value;
        $this->_setField('credentialDeviceType');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCredentialBackedUp(): ?bool
    {
        return $this->credentialBackedUp;
    }

    /**
     * @param ?bool $value
     */
    public function setCredentialBackedUp(?bool $value = null): self
    {
        $this->credentialBackedUp = $value;
        $this->_setField('credentialBackedUp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIdentityUserId(): ?string
    {
        return $this->identityUserId;
    }

    /**
     * @param ?string $value
     */
    public function setIdentityUserId(?string $value = null): self
    {
        $this->identityUserId = $value;
        $this->_setField('identityUserId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param ?string $value
     */
    public function setUserAgent(?string $value = null): self
    {
        $this->userAgent = $value;
        $this->_setField('userAgent');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAaguid(): ?string
    {
        return $this->aaguid;
    }

    /**
     * @param ?string $value
     */
    public function setAaguid(?string $value = null): self
    {
        $this->aaguid = $value;
        $this->_setField('aaguid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRelyingPartyIdentifier(): ?string
    {
        return $this->relyingPartyIdentifier;
    }

    /**
     * @param ?string $value
     */
    public function setRelyingPartyIdentifier(?string $value = null): self
    {
        $this->relyingPartyIdentifier = $value;
        $this->_setField('relyingPartyIdentifier');
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
