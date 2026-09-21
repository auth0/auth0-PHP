<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'pingfederate' connection
 */
class EventStreamCloudEventConnectionCreatedPreviousObject3Options extends JsonSerializableType
{
    /**
     * @var ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings $assertionDecryptionSettings
     */
    #[JsonProperty('assertion_decryption_settings')]
    private ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings $assertionDecryptionSettings;

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
     * @var ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsDigestAlgorithmEnum> $digestAlgorithm
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
     * @var ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated $idpinitiated
     */
    #[JsonProperty('idpinitiated')]
    private ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated $idpinitiated;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsProtocolBindingEnum> $protocolBinding
     */
    #[JsonProperty('protocolBinding')]
    private ?string $protocolBinding;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSignatureAlgorithmEnum> $signatureAlgorithm
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
     * @var ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject $subject
     */
    #[JsonProperty('subject')]
    private ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject $subject;

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
     * @var string $pingFederateBaseUrl URL provided by PingFederate which returns information used for creating the connection
     */
    #[JsonProperty('pingFederateBaseUrl')]
    private string $pingFederateBaseUrl;

    /**
     * @param array{
     *   pingFederateBaseUrl: string,
     *   assertionDecryptionSettings?: ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings,
     *   cert?: ?string,
     *   certRolloverNotification?: ?DateTime,
     *   digestAlgorithm?: ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsDigestAlgorithmEnum>,
     *   domainAliases?: ?array<string>,
     *   entityId?: ?string,
     *   expires?: ?DateTime,
     *   iconUrl?: ?string,
     *   idpinitiated?: ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated,
     *   nonPersistentAttrs?: ?array<string>,
     *   protocolBinding?: ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsProtocolBindingEnum>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSetUserRootAttributesEnum>,
     *   signatureAlgorithm?: ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSignatureAlgorithmEnum>,
     *   signInEndpoint?: ?string,
     *   signingCert?: ?string,
     *   signSamlRequest?: ?bool,
     *   subject?: ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
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
        $this->pingFederateBaseUrl = $values['pingFederateBaseUrl'];
    }

    /**
     * @return ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings
     */
    public function getAssertionDecryptionSettings(): ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings
    {
        return $this->assertionDecryptionSettings;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings $value
     */
    public function setAssertionDecryptionSettings(?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsAssertionDecryptionSettings $value = null): self
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
     * @return ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsDigestAlgorithmEnum>
     */
    public function getDigestAlgorithm(): ?string
    {
        return $this->digestAlgorithm;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsDigestAlgorithmEnum> $value
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
     * @return ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated
     */
    public function getIdpinitiated(): ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated
    {
        return $this->idpinitiated;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated $value
     */
    public function setIdpinitiated(?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsIdpinitiated $value = null): self
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
     * @return ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsProtocolBindingEnum>
     */
    public function getProtocolBinding(): ?string
    {
        return $this->protocolBinding;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsProtocolBindingEnum> $value
     */
    public function setProtocolBinding(?string $value = null): self
    {
        $this->protocolBinding = $value;
        $this->_setField('protocolBinding');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSignatureAlgorithmEnum>
     */
    public function getSignatureAlgorithm(): ?string
    {
        return $this->signatureAlgorithm;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSignatureAlgorithmEnum> $value
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
     * @return ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject
     */
    public function getSubject(): ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject
    {
        return $this->subject;
    }

    /**
     * @param ?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject $value
     */
    public function setSubject(?EventStreamCloudEventConnectionCreatedPreviousObject3OptionsSubject $value = null): self
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
     * @return string
     */
    public function getPingFederateBaseUrl(): string
    {
        return $this->pingFederateBaseUrl;
    }

    /**
     * @param string $value
     */
    public function setPingFederateBaseUrl(string $value): self
    {
        $this->pingFederateBaseUrl = $value;
        $this->_setField('pingFederateBaseUrl');
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
