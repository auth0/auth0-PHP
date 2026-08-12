<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetResourceServerResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id ID of the API (resource server).
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name Friendly name for this resource server. Can not contain `<` or `>` characters.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?bool $isSystem Whether this is an Auth0 system API (true) or a custom API (false).
     */
    #[JsonProperty('is_system')]
    private ?bool $isSystem;

    /**
     * @var ?string $identifier Unique identifier for the API used as the audience parameter on authorization calls. Can not be changed once set.
     */
    #[JsonProperty('identifier')]
    private ?string $identifier;

    /**
     * @var ?array<ResourceServerScope> $scopes List of permissions (scopes) that this API uses.
     */
    #[JsonProperty('scopes'), ArrayType([ResourceServerScope::class])]
    private ?array $scopes;

    /**
     * @var ?value-of<SigningAlgorithmEnum> $signingAlg
     */
    #[JsonProperty('signing_alg')]
    private ?string $signingAlg;

    /**
     * @var ?string $signingSecret Secret used to sign tokens when using symmetric algorithms (HS256).
     */
    #[JsonProperty('signing_secret')]
    private ?string $signingSecret;

    /**
     * @var ?bool $allowOfflineAccess Whether refresh tokens can be issued for this API (true) or not (false).
     */
    #[JsonProperty('allow_offline_access')]
    private ?bool $allowOfflineAccess;

    /**
     * @var ?bool $allowOnlineAccess Whether Online Refresh Tokens can be issued for this API (true) or not (false).
     */
    #[JsonProperty('allow_online_access')]
    private ?bool $allowOnlineAccess;

    /**
     * @var ?bool $allowOnlineAccessWithEphemeralSessions Whether Online Refresh Tokens can be issued even when sessions are configured as ephemeral (true) or not (false).
     */
    #[JsonProperty('allow_online_access_with_ephemeral_sessions')]
    private ?bool $allowOnlineAccessWithEphemeralSessions;

    /**
     * @var ?bool $skipConsentForVerifiableFirstPartyClients Whether to skip user consent for applications flagged as first party (true) or not (false).
     */
    #[JsonProperty('skip_consent_for_verifiable_first_party_clients')]
    private ?bool $skipConsentForVerifiableFirstPartyClients;

    /**
     * @var ?int $tokenLifetime Expiration value (in seconds) for access tokens issued for this API from the token endpoint.
     */
    #[JsonProperty('token_lifetime')]
    private ?int $tokenLifetime;

    /**
     * @var ?int $tokenLifetimeForWeb Expiration value (in seconds) for access tokens issued for this API via Implicit or Hybrid Flows. Cannot be greater than the `token_lifetime` value.
     */
    #[JsonProperty('token_lifetime_for_web')]
    private ?int $tokenLifetimeForWeb;

    /**
     * @var ?bool $enforcePolicies Whether authorization polices are enforced (true) or unenforced (false).
     */
    #[JsonProperty('enforce_policies')]
    private ?bool $enforcePolicies;

    /**
     * @var ?value-of<ResourceServerTokenDialectResponseEnum> $tokenDialect
     */
    #[JsonProperty('token_dialect')]
    private ?string $tokenDialect;

    /**
     * @var ?ResourceServerTokenEncryption $tokenEncryption
     */
    #[JsonProperty('token_encryption')]
    private ?ResourceServerTokenEncryption $tokenEncryption;

    /**
     * @var ?value-of<ResourceServerConsentPolicyEnum> $consentPolicy
     */
    #[JsonProperty('consent_policy')]
    private ?string $consentPolicy;

    /**
     * @var ?array<mixed> $authorizationDetails
     */
    #[JsonProperty('authorization_details'), ArrayType(['mixed'])]
    private ?array $authorizationDetails;

    /**
     * @var ?ResourceServerProofOfPossession $proofOfPossession
     */
    #[JsonProperty('proof_of_possession')]
    private ?ResourceServerProofOfPossession $proofOfPossession;

    /**
     * @var ?ResourceServerSubjectTypeAuthorization $subjectTypeAuthorization
     */
    #[JsonProperty('subject_type_authorization')]
    private ?ResourceServerSubjectTypeAuthorization $subjectTypeAuthorization;

    /**
     * @var ?ResourceServerAuthorizationPolicy $authorizationPolicy
     */
    #[JsonProperty('authorization_policy')]
    private ?ResourceServerAuthorizationPolicy $authorizationPolicy;

    /**
     * @var ?string $clientId The client ID of the client that this resource server is linked to
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   isSystem?: ?bool,
     *   identifier?: ?string,
     *   scopes?: ?array<ResourceServerScope>,
     *   signingAlg?: ?value-of<SigningAlgorithmEnum>,
     *   signingSecret?: ?string,
     *   allowOfflineAccess?: ?bool,
     *   allowOnlineAccess?: ?bool,
     *   allowOnlineAccessWithEphemeralSessions?: ?bool,
     *   skipConsentForVerifiableFirstPartyClients?: ?bool,
     *   tokenLifetime?: ?int,
     *   tokenLifetimeForWeb?: ?int,
     *   enforcePolicies?: ?bool,
     *   tokenDialect?: ?value-of<ResourceServerTokenDialectResponseEnum>,
     *   tokenEncryption?: ?ResourceServerTokenEncryption,
     *   consentPolicy?: ?value-of<ResourceServerConsentPolicyEnum>,
     *   authorizationDetails?: ?array<mixed>,
     *   proofOfPossession?: ?ResourceServerProofOfPossession,
     *   subjectTypeAuthorization?: ?ResourceServerSubjectTypeAuthorization,
     *   authorizationPolicy?: ?ResourceServerAuthorizationPolicy,
     *   clientId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->isSystem = $values['isSystem'] ?? null;
        $this->identifier = $values['identifier'] ?? null;
        $this->scopes = $values['scopes'] ?? null;
        $this->signingAlg = $values['signingAlg'] ?? null;
        $this->signingSecret = $values['signingSecret'] ?? null;
        $this->allowOfflineAccess = $values['allowOfflineAccess'] ?? null;
        $this->allowOnlineAccess = $values['allowOnlineAccess'] ?? null;
        $this->allowOnlineAccessWithEphemeralSessions = $values['allowOnlineAccessWithEphemeralSessions'] ?? null;
        $this->skipConsentForVerifiableFirstPartyClients = $values['skipConsentForVerifiableFirstPartyClients'] ?? null;
        $this->tokenLifetime = $values['tokenLifetime'] ?? null;
        $this->tokenLifetimeForWeb = $values['tokenLifetimeForWeb'] ?? null;
        $this->enforcePolicies = $values['enforcePolicies'] ?? null;
        $this->tokenDialect = $values['tokenDialect'] ?? null;
        $this->tokenEncryption = $values['tokenEncryption'] ?? null;
        $this->consentPolicy = $values['consentPolicy'] ?? null;
        $this->authorizationDetails = $values['authorizationDetails'] ?? null;
        $this->proofOfPossession = $values['proofOfPossession'] ?? null;
        $this->subjectTypeAuthorization = $values['subjectTypeAuthorization'] ?? null;
        $this->authorizationPolicy = $values['authorizationPolicy'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
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
     * @return ?bool
     */
    public function getIsSystem(): ?bool
    {
        return $this->isSystem;
    }

    /**
     * @param ?bool $value
     */
    public function setIsSystem(?bool $value = null): self
    {
        $this->isSystem = $value;
        $this->_setField('isSystem');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param ?string $value
     */
    public function setIdentifier(?string $value = null): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }

    /**
     * @return ?array<ResourceServerScope>
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param ?array<ResourceServerScope> $value
     */
    public function setScopes(?array $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return ?value-of<SigningAlgorithmEnum>
     */
    public function getSigningAlg(): ?string
    {
        return $this->signingAlg;
    }

    /**
     * @param ?value-of<SigningAlgorithmEnum> $value
     */
    public function setSigningAlg(?string $value = null): self
    {
        $this->signingAlg = $value;
        $this->_setField('signingAlg');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSigningSecret(): ?string
    {
        return $this->signingSecret;
    }

    /**
     * @param ?string $value
     */
    public function setSigningSecret(?string $value = null): self
    {
        $this->signingSecret = $value;
        $this->_setField('signingSecret');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowOfflineAccess(): ?bool
    {
        return $this->allowOfflineAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowOfflineAccess(?bool $value = null): self
    {
        $this->allowOfflineAccess = $value;
        $this->_setField('allowOfflineAccess');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowOnlineAccess(): ?bool
    {
        return $this->allowOnlineAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowOnlineAccess(?bool $value = null): self
    {
        $this->allowOnlineAccess = $value;
        $this->_setField('allowOnlineAccess');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowOnlineAccessWithEphemeralSessions(): ?bool
    {
        return $this->allowOnlineAccessWithEphemeralSessions;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowOnlineAccessWithEphemeralSessions(?bool $value = null): self
    {
        $this->allowOnlineAccessWithEphemeralSessions = $value;
        $this->_setField('allowOnlineAccessWithEphemeralSessions');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSkipConsentForVerifiableFirstPartyClients(): ?bool
    {
        return $this->skipConsentForVerifiableFirstPartyClients;
    }

    /**
     * @param ?bool $value
     */
    public function setSkipConsentForVerifiableFirstPartyClients(?bool $value = null): self
    {
        $this->skipConsentForVerifiableFirstPartyClients = $value;
        $this->_setField('skipConsentForVerifiableFirstPartyClients');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTokenLifetime(): ?int
    {
        return $this->tokenLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setTokenLifetime(?int $value = null): self
    {
        $this->tokenLifetime = $value;
        $this->_setField('tokenLifetime');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTokenLifetimeForWeb(): ?int
    {
        return $this->tokenLifetimeForWeb;
    }

    /**
     * @param ?int $value
     */
    public function setTokenLifetimeForWeb(?int $value = null): self
    {
        $this->tokenLifetimeForWeb = $value;
        $this->_setField('tokenLifetimeForWeb');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEnforcePolicies(): ?bool
    {
        return $this->enforcePolicies;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforcePolicies(?bool $value = null): self
    {
        $this->enforcePolicies = $value;
        $this->_setField('enforcePolicies');
        return $this;
    }

    /**
     * @return ?value-of<ResourceServerTokenDialectResponseEnum>
     */
    public function getTokenDialect(): ?string
    {
        return $this->tokenDialect;
    }

    /**
     * @param ?value-of<ResourceServerTokenDialectResponseEnum> $value
     */
    public function setTokenDialect(?string $value = null): self
    {
        $this->tokenDialect = $value;
        $this->_setField('tokenDialect');
        return $this;
    }

    /**
     * @return ?ResourceServerTokenEncryption
     */
    public function getTokenEncryption(): ?ResourceServerTokenEncryption
    {
        return $this->tokenEncryption;
    }

    /**
     * @param ?ResourceServerTokenEncryption $value
     */
    public function setTokenEncryption(?ResourceServerTokenEncryption $value = null): self
    {
        $this->tokenEncryption = $value;
        $this->_setField('tokenEncryption');
        return $this;
    }

    /**
     * @return ?value-of<ResourceServerConsentPolicyEnum>
     */
    public function getConsentPolicy(): ?string
    {
        return $this->consentPolicy;
    }

    /**
     * @param ?value-of<ResourceServerConsentPolicyEnum> $value
     */
    public function setConsentPolicy(?string $value = null): self
    {
        $this->consentPolicy = $value;
        $this->_setField('consentPolicy');
        return $this;
    }

    /**
     * @return ?array<mixed>
     */
    public function getAuthorizationDetails(): ?array
    {
        return $this->authorizationDetails;
    }

    /**
     * @param ?array<mixed> $value
     */
    public function setAuthorizationDetails(?array $value = null): self
    {
        $this->authorizationDetails = $value;
        $this->_setField('authorizationDetails');
        return $this;
    }

    /**
     * @return ?ResourceServerProofOfPossession
     */
    public function getProofOfPossession(): ?ResourceServerProofOfPossession
    {
        return $this->proofOfPossession;
    }

    /**
     * @param ?ResourceServerProofOfPossession $value
     */
    public function setProofOfPossession(?ResourceServerProofOfPossession $value = null): self
    {
        $this->proofOfPossession = $value;
        $this->_setField('proofOfPossession');
        return $this;
    }

    /**
     * @return ?ResourceServerSubjectTypeAuthorization
     */
    public function getSubjectTypeAuthorization(): ?ResourceServerSubjectTypeAuthorization
    {
        return $this->subjectTypeAuthorization;
    }

    /**
     * @param ?ResourceServerSubjectTypeAuthorization $value
     */
    public function setSubjectTypeAuthorization(?ResourceServerSubjectTypeAuthorization $value = null): self
    {
        $this->subjectTypeAuthorization = $value;
        $this->_setField('subjectTypeAuthorization');
        return $this;
    }

    /**
     * @return ?ResourceServerAuthorizationPolicy
     */
    public function getAuthorizationPolicy(): ?ResourceServerAuthorizationPolicy
    {
        return $this->authorizationPolicy;
    }

    /**
     * @param ?ResourceServerAuthorizationPolicy $value
     */
    public function setAuthorizationPolicy(?ResourceServerAuthorizationPolicy $value = null): self
    {
        $this->authorizationPolicy = $value;
        $this->_setField('authorizationPolicy');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
