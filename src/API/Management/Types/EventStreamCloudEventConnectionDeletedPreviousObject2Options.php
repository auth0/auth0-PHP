<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'samlp' connection
 */
class EventStreamCloudEventConnectionDeletedPreviousObject2Options extends JsonSerializableType
{
    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings $assertionDecryptionSettings
     */
    #[JsonProperty('assertion_decryption_settings')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings $assertionDecryptionSettings;

    /**
     * @var ?string $cert X.509 signing certificate from the identity provider in .der format. Used to validate signatures in SAML Responses and Assertions. This is an alternative to signingCert and is kept for backward compatibility. Prefer using signingCert instead.
     */
    #[JsonProperty('cert')]
    private ?string $cert;

    /**
     * @var ?DateTime $certRolloverNotification Timestamp of the last certificate expiring soon notification.
     */
    #[JsonProperty('cert_rollover_notification'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $certRolloverNotification;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsDigestAlgorithmEnum> $digestAlgorithm
     */
    #[JsonProperty('digestAlgorithm')]
    private ?string $digestAlgorithm;

    /**
     * @var ?array<string> $domainAliases Domain aliases for the connection
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?string $entityId The entity identifier (Issuer) for the SAML Service Provider. When not provided, defaults to 'urn:auth0:{tenant}:{connection}'. This value is included in SAML AuthnRequest messages sent to the identity provider.
     */
    #[JsonProperty('entityId')]
    private ?string $entityId;

    /**
     * @var ?DateTime $expires ISO 8601 formatted datetime indicating when the identity provider's signing certificate expires.
     */
    #[JsonProperty('expires'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expires;

    /**
     * @var ?string $iconUrl URL for the connection icon displayed in Auth0 login pages. Accepts HTTPS URLs. Used for visual branding in authentication flows.
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated $idpinitiated
     */
    #[JsonProperty('idpinitiated')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated $idpinitiated;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsProtocolBindingEnum> $protocolBinding
     */
    #[JsonProperty('protocolBinding')]
    private ?string $protocolBinding;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSignatureAlgorithmEnum> $signatureAlgorithm
     */
    #[JsonProperty('signatureAlgorithm')]
    private ?string $signatureAlgorithm;

    /**
     * @var ?string $signInEndpoint Identity provider's SAML SingleSignOnService endpoint URL where Auth0 sends SAML authentication requests. This is the primary login URL for the SAML connection. Required unless using metadataUrl or metadataXml.
     */
    #[JsonProperty('signInEndpoint')]
    private ?string $signInEndpoint;

    /**
     * @var ?string $signingCert Base64-encoded X.509 certificate from the identity provider used to validate signatures in SAML responses and assertions. The certificate is decoded and used for cryptographic signature verification.
     */
    #[JsonProperty('signingCert')]
    private ?string $signingCert;

    /**
     * @var ?bool $signSamlRequest When true, Auth0 signs SAML authentication requests using the connection's signing key. The signature includes the request's digest and is validated by the identity provider. Defaults to false (unsigned requests).
     */
    #[JsonProperty('signSAMLRequest')]
    private ?bool $signSamlRequest;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject $subject
     */
    #[JsonProperty('subject')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject $subject;

    /**
     * @var ?string $tenantDomain For SAML connections, the tenant domain used to construct the login endpoint URL. Can be a string for single-tenant or an array of strings for multi-tenant validation.
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string> $thumbprints SHA-1 thumbprints (fingerprints) of the identity provider's signing certificates. Automatically computed from signingCert during connection creation. Each thumbprint must be a 40-character hexadecimal string.
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $debug When true, enables detailed SAML debugging by issuing 'w' (warning) events in tenant logs containing SAML request/response details. WARNING: Potentially exposes sensitive user information (PII, credentials) and should only be enabled temporarily for debugging purposes.
     */
    #[JsonProperty('debug')]
    private ?bool $debug;

    /**
     * @var ?bool $deflate When true, enables DEFLATE compression for SAML requests sent via HTTP-Redirect binding.
     */
    #[JsonProperty('deflate')]
    private ?bool $deflate;

    /**
     * @var ?string $destinationUrl The URL where Auth0 will send SAML authentication requests (the Identity Provider's SSO URL). Must be a valid HTTPS URL.
     */
    #[JsonProperty('destinationUrl')]
    private ?string $destinationUrl;

    /**
     * @var ?bool $disableFieldsMapFix When true, disables the automatic correction of the fieldsMap configuration to ensure proper mapping of SAML attributes to user profile fields. Defaults to false (fieldsMap fix enabled).
     */
    #[JsonProperty('disableFieldsMapFix')]
    private ?bool $disableFieldsMapFix;

    /**
     * @var ?bool $disableSignout When true, disables sending SAML logout requests (SingleLogoutService) to the identity provider during user sign-out. The user will be logged out of Auth0 but will remain logged into the identity provider. Defaults to false (federated logout enabled).
     */
    #[JsonProperty('disableSignout')]
    private ?bool $disableSignout;

    /**
     * @var ?string $discoveryUrl URL of the identity provider's OIDC Discovery endpoint (/.well-known/openid-configuration). When provided and oidc_metadata is empty, Auth0 automatically retrieves the provider's configuration including endpoints and supported features. Used with Cross App Access.
     */
    #[JsonProperty('discovery_url')]
    private ?string $discoveryUrl;

    /**
     * @var ?array<string, mixed> $fieldsMap
     */
    #[JsonProperty('fieldsMap'), ArrayType(['string' => 'mixed'])]
    private ?array $fieldsMap;

    /**
     * @var ?string $fieldsMapJsonRaw Raw JSON string representation of the fieldsMap configuration. Used internally for storage and retrieval of the fieldsMap object.
     */
    #[JsonProperty('fieldsMapJsonRaw')]
    private ?string $fieldsMapJsonRaw;

    /**
     * @var ?string $globalTokenRevocationJwtIss Expected 'iss' (Issuer) claim value for JWT tokens in Global Token Revocation requests from the identity provider. When configured, Auth0 validates the JWT issuer matches this value before processing token revocation. Must be used together with global_token_revocation_jwt_sub.
     */
    #[JsonProperty('global_token_revocation_jwt_iss')]
    private ?string $globalTokenRevocationJwtIss;

    /**
     * @var ?string $globalTokenRevocationJwtSub Expected 'sub' (Subject) claim value for JWT tokens in Global Token Revocation requests from the identity provider. When configured, Auth0 validates the JWT subject matches this value before processing token revocation. Must be used together with global_token_revocation_jwt_iss.
     */
    #[JsonProperty('global_token_revocation_jwt_sub')]
    private ?string $globalTokenRevocationJwtSub;

    /**
     * @var ?string $metadataUrl HTTPS URL to the identity provider's SAML metadata document. When provided, Auth0 automatically fetches and parses the metadata to extract signInEndpoint, signOutEndpoint, signingCert, signSAMLRequest, and protocolBinding. Use metadataUrl OR metadataXml, not both.
     */
    #[JsonProperty('metadataUrl')]
    private ?string $metadataUrl;

    /**
     * @var ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata $oidcMetadata
     */
    #[JsonProperty('oidc_metadata')]
    private ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata $oidcMetadata;

    /**
     * @var ?string $recipientUrl The URL where Auth0 will send SAML authentication requests (the Identity Provider's SSO URL). Must be a valid HTTPS URL.
     */
    #[JsonProperty('recipientUrl')]
    private ?string $recipientUrl;

    /**
     * @var ?string $requestTemplate Custom XML template for SAML authentication requests. Supports variable substitution using @@variableName@@ syntax. When not provided, uses default SAML AuthnRequest template. See https://auth0.com/docs/authenticate/protocols/saml/saml-sso-integrations/configure-auth0-saml-service-provider#customize-the-request-template
     */
    #[JsonProperty('requestTemplate')]
    private ?string $requestTemplate;

    /**
     * @var ?string $signOutEndpoint Identity provider's SAML SingleLogoutService endpoint URL where Auth0 sends logout requests for federated sign-out. When not provided, defaults to signInEndpoint. Only used if disableSignout is false.
     */
    #[JsonProperty('signOutEndpoint')]
    private ?string $signOutEndpoint;

    /**
     * @var ?string $userIdAttribute Custom SAML assertion attribute to use as the unique user identifier. When provided, this attribute is prepended to the default user_id mapping list with highest priority. Accepts a string (single SAML attribute name).
     */
    #[JsonProperty('user_id_attribute')]
    private ?string $userIdAttribute;

    /**
     * @param array{
     *   assertionDecryptionSettings?: ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings,
     *   cert?: ?string,
     *   certRolloverNotification?: ?DateTime,
     *   digestAlgorithm?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsDigestAlgorithmEnum>,
     *   domainAliases?: ?array<string>,
     *   entityId?: ?string,
     *   expires?: ?DateTime,
     *   iconUrl?: ?string,
     *   idpinitiated?: ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated,
     *   nonPersistentAttrs?: ?array<string>,
     *   protocolBinding?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsProtocolBindingEnum>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSetUserRootAttributesEnum>,
     *   signatureAlgorithm?: ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSignatureAlgorithmEnum>,
     *   signInEndpoint?: ?string,
     *   signingCert?: ?string,
     *   signSamlRequest?: ?bool,
     *   subject?: ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, mixed>,
     *   debug?: ?bool,
     *   deflate?: ?bool,
     *   destinationUrl?: ?string,
     *   disableFieldsMapFix?: ?bool,
     *   disableSignout?: ?bool,
     *   discoveryUrl?: ?string,
     *   fieldsMap?: ?array<string, mixed>,
     *   fieldsMapJsonRaw?: ?string,
     *   globalTokenRevocationJwtIss?: ?string,
     *   globalTokenRevocationJwtSub?: ?string,
     *   metadataUrl?: ?string,
     *   oidcMetadata?: ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata,
     *   recipientUrl?: ?string,
     *   requestTemplate?: ?string,
     *   signOutEndpoint?: ?string,
     *   userIdAttribute?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->assertionDecryptionSettings = $values['assertionDecryptionSettings'] ?? null;
        $this->cert = $values['cert'] ?? null;
        $this->certRolloverNotification = $values['certRolloverNotification'] ?? null;
        $this->digestAlgorithm = $values['digestAlgorithm'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
        $this->expires = $values['expires'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->idpinitiated = $values['idpinitiated'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->protocolBinding = $values['protocolBinding'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->signatureAlgorithm = $values['signatureAlgorithm'] ?? null;
        $this->signInEndpoint = $values['signInEndpoint'] ?? null;
        $this->signingCert = $values['signingCert'] ?? null;
        $this->signSamlRequest = $values['signSamlRequest'] ?? null;
        $this->subject = $values['subject'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->debug = $values['debug'] ?? null;
        $this->deflate = $values['deflate'] ?? null;
        $this->destinationUrl = $values['destinationUrl'] ?? null;
        $this->disableFieldsMapFix = $values['disableFieldsMapFix'] ?? null;
        $this->disableSignout = $values['disableSignout'] ?? null;
        $this->discoveryUrl = $values['discoveryUrl'] ?? null;
        $this->fieldsMap = $values['fieldsMap'] ?? null;
        $this->fieldsMapJsonRaw = $values['fieldsMapJsonRaw'] ?? null;
        $this->globalTokenRevocationJwtIss = $values['globalTokenRevocationJwtIss'] ?? null;
        $this->globalTokenRevocationJwtSub = $values['globalTokenRevocationJwtSub'] ?? null;
        $this->metadataUrl = $values['metadataUrl'] ?? null;
        $this->oidcMetadata = $values['oidcMetadata'] ?? null;
        $this->recipientUrl = $values['recipientUrl'] ?? null;
        $this->requestTemplate = $values['requestTemplate'] ?? null;
        $this->signOutEndpoint = $values['signOutEndpoint'] ?? null;
        $this->userIdAttribute = $values['userIdAttribute'] ?? null;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings
     */
    public function getAssertionDecryptionSettings(): ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings
    {
        return $this->assertionDecryptionSettings;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings $value
     */
    public function setAssertionDecryptionSettings(?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsAssertionDecryptionSettings $value = null): self
    {
        $this->assertionDecryptionSettings = $value;
        $this->_setField('assertionDecryptionSettings');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCert(): ?string
    {
        return $this->cert;
    }

    /**
     * @param ?string $value
     */
    public function setCert(?string $value = null): self
    {
        $this->cert = $value;
        $this->_setField('cert');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCertRolloverNotification(): ?DateTime
    {
        return $this->certRolloverNotification;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCertRolloverNotification(?DateTime $value = null): self
    {
        $this->certRolloverNotification = $value;
        $this->_setField('certRolloverNotification');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsDigestAlgorithmEnum>
     */
    public function getDigestAlgorithm(): ?string
    {
        return $this->digestAlgorithm;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsDigestAlgorithmEnum> $value
     */
    public function setDigestAlgorithm(?string $value = null): self
    {
        $this->digestAlgorithm = $value;
        $this->_setField('digestAlgorithm');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDomainAliases(): ?array
    {
        return $this->domainAliases;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDomainAliases(?array $value = null): self
    {
        $this->domainAliases = $value;
        $this->_setField('domainAliases');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    /**
     * @param ?string $value
     */
    public function setEntityId(?string $value = null): self
    {
        $this->entityId = $value;
        $this->_setField('entityId');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getExpires(): ?DateTime
    {
        return $this->expires;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpires(?DateTime $value = null): self
    {
        $this->expires = $value;
        $this->_setField('expires');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    /**
     * @param ?string $value
     */
    public function setIconUrl(?string $value = null): self
    {
        $this->iconUrl = $value;
        $this->_setField('iconUrl');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated
     */
    public function getIdpinitiated(): ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated
    {
        return $this->idpinitiated;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated $value
     */
    public function setIdpinitiated(?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsIdpinitiated $value = null): self
    {
        $this->idpinitiated = $value;
        $this->_setField('idpinitiated');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getNonPersistentAttrs(): ?array
    {
        return $this->nonPersistentAttrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setNonPersistentAttrs(?array $value = null): self
    {
        $this->nonPersistentAttrs = $value;
        $this->_setField('nonPersistentAttrs');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsProtocolBindingEnum>
     */
    public function getProtocolBinding(): ?string
    {
        return $this->protocolBinding;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsProtocolBindingEnum> $value
     */
    public function setProtocolBinding(?string $value = null): self
    {
        $this->protocolBinding = $value;
        $this->_setField('protocolBinding');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSignatureAlgorithmEnum>
     */
    public function getSignatureAlgorithm(): ?string
    {
        return $this->signatureAlgorithm;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSignatureAlgorithmEnum> $value
     */
    public function setSignatureAlgorithm(?string $value = null): self
    {
        $this->signatureAlgorithm = $value;
        $this->_setField('signatureAlgorithm');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSignInEndpoint(): ?string
    {
        return $this->signInEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setSignInEndpoint(?string $value = null): self
    {
        $this->signInEndpoint = $value;
        $this->_setField('signInEndpoint');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSigningCert(): ?string
    {
        return $this->signingCert;
    }

    /**
     * @param ?string $value
     */
    public function setSigningCert(?string $value = null): self
    {
        $this->signingCert = $value;
        $this->_setField('signingCert');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSignSamlRequest(): ?bool
    {
        return $this->signSamlRequest;
    }

    /**
     * @param ?bool $value
     */
    public function setSignSamlRequest(?bool $value = null): self
    {
        $this->signSamlRequest = $value;
        $this->_setField('signSamlRequest');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject
     */
    public function getSubject(): ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject
    {
        return $this->subject;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject $value
     */
    public function setSubject(?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsSubject $value = null): self
    {
        $this->subject = $value;
        $this->_setField('subject');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenantDomain(): ?string
    {
        return $this->tenantDomain;
    }

    /**
     * @param ?string $value
     */
    public function setTenantDomain(?string $value = null): self
    {
        $this->tenantDomain = $value;
        $this->_setField('tenantDomain');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getThumbprints(): ?array
    {
        return $this->thumbprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setThumbprints(?array $value = null): self
    {
        $this->thumbprints = $value;
        $this->_setField('thumbprints');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setUpstreamParams(?array $value = null): self
    {
        $this->upstreamParams = $value;
        $this->_setField('upstreamParams');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDebug(): ?bool
    {
        return $this->debug;
    }

    /**
     * @param ?bool $value
     */
    public function setDebug(?bool $value = null): self
    {
        $this->debug = $value;
        $this->_setField('debug');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDeflate(): ?bool
    {
        return $this->deflate;
    }

    /**
     * @param ?bool $value
     */
    public function setDeflate(?bool $value = null): self
    {
        $this->deflate = $value;
        $this->_setField('deflate');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDestinationUrl(): ?string
    {
        return $this->destinationUrl;
    }

    /**
     * @param ?string $value
     */
    public function setDestinationUrl(?string $value = null): self
    {
        $this->destinationUrl = $value;
        $this->_setField('destinationUrl');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableFieldsMapFix(): ?bool
    {
        return $this->disableFieldsMapFix;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableFieldsMapFix(?bool $value = null): self
    {
        $this->disableFieldsMapFix = $value;
        $this->_setField('disableFieldsMapFix');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSignout(): ?bool
    {
        return $this->disableSignout;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSignout(?bool $value = null): self
    {
        $this->disableSignout = $value;
        $this->_setField('disableSignout');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDiscoveryUrl(): ?string
    {
        return $this->discoveryUrl;
    }

    /**
     * @param ?string $value
     */
    public function setDiscoveryUrl(?string $value = null): self
    {
        $this->discoveryUrl = $value;
        $this->_setField('discoveryUrl');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getFieldsMap(): ?array
    {
        return $this->fieldsMap;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setFieldsMap(?array $value = null): self
    {
        $this->fieldsMap = $value;
        $this->_setField('fieldsMap');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFieldsMapJsonRaw(): ?string
    {
        return $this->fieldsMapJsonRaw;
    }

    /**
     * @param ?string $value
     */
    public function setFieldsMapJsonRaw(?string $value = null): self
    {
        $this->fieldsMapJsonRaw = $value;
        $this->_setField('fieldsMapJsonRaw');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGlobalTokenRevocationJwtIss(): ?string
    {
        return $this->globalTokenRevocationJwtIss;
    }

    /**
     * @param ?string $value
     */
    public function setGlobalTokenRevocationJwtIss(?string $value = null): self
    {
        $this->globalTokenRevocationJwtIss = $value;
        $this->_setField('globalTokenRevocationJwtIss');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getGlobalTokenRevocationJwtSub(): ?string
    {
        return $this->globalTokenRevocationJwtSub;
    }

    /**
     * @param ?string $value
     */
    public function setGlobalTokenRevocationJwtSub(?string $value = null): self
    {
        $this->globalTokenRevocationJwtSub = $value;
        $this->_setField('globalTokenRevocationJwtSub');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMetadataUrl(): ?string
    {
        return $this->metadataUrl;
    }

    /**
     * @param ?string $value
     */
    public function setMetadataUrl(?string $value = null): self
    {
        $this->metadataUrl = $value;
        $this->_setField('metadataUrl');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata
     */
    public function getOidcMetadata(): ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata
    {
        return $this->oidcMetadata;
    }

    /**
     * @param ?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata $value
     */
    public function setOidcMetadata(?EventStreamCloudEventConnectionDeletedPreviousObject2OptionsOidcMetadata $value = null): self
    {
        $this->oidcMetadata = $value;
        $this->_setField('oidcMetadata');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRecipientUrl(): ?string
    {
        return $this->recipientUrl;
    }

    /**
     * @param ?string $value
     */
    public function setRecipientUrl(?string $value = null): self
    {
        $this->recipientUrl = $value;
        $this->_setField('recipientUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRequestTemplate(): ?string
    {
        return $this->requestTemplate;
    }

    /**
     * @param ?string $value
     */
    public function setRequestTemplate(?string $value = null): self
    {
        $this->requestTemplate = $value;
        $this->_setField('requestTemplate');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSignOutEndpoint(): ?string
    {
        return $this->signOutEndpoint;
    }

    /**
     * @param ?string $value
     */
    public function setSignOutEndpoint(?string $value = null): self
    {
        $this->signOutEndpoint = $value;
        $this->_setField('signOutEndpoint');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserIdAttribute(): ?string
    {
        return $this->userIdAttribute;
    }

    /**
     * @param ?string $value
     */
    public function setUserIdAttribute(?string $value = null): self
    {
        $this->userIdAttribute = $value;
        $this->_setField('userIdAttribute');
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
