<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'adfs' connection
 */
class EventStreamCloudEventConnectionUpdatedObject4Options extends JsonSerializableType
{
    /**
     * @var ?string $adfsServer ADFS federation metadata host or XML URL used to discover WS-Fed endpoints and certificates. Errors if adfs_server and fedMetadataXml are both absent.
     */
    #[JsonProperty('adfs_server')]
    private ?string $adfsServer;

    /**
     * @var ?DateTime $certRolloverNotification Timestamp of the last certificate expiring soon notification.
     */
    #[JsonProperty('cert_rollover_notification'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $certRolloverNotification;

    /**
     * @var ?array<string> $domainAliases Email domains associated with this connection for Home Realm Discovery (HRD). When a user's email matches one of these domains, they are automatically routed to this connection during authentication.
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?string $entityId The entity identifier (Issuer) for the ADFS Service Provider. When not provided, defaults to 'urn:auth0:{tenant}:{connection}'.
     */
    #[JsonProperty('entityId')]
    private ?string $entityId;

    /**
     * @var ?string $fedMetadataXml Inline XML alternative to 'adfs_server'. Cannot be set together with 'adfs_server'.
     */
    #[JsonProperty('fedMetadataXml')]
    private ?string $fedMetadataXml;

    /**
     * @var ?string $iconUrl URL for the connection icon displayed in Auth0 login pages. Accepts HTTPS URLs. Used for visual branding in authentication flows.
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?array<string> $prevThumbprints Array of certificate thumbprints (SHA-128/SHA-256/SHA-512 hex hashes) for validating SAML signatures. Used with WS-Federation protocol. Maximum 20 thumbprints. Each thumbprint must be a hexadecimal string.
     */
    #[JsonProperty('prev_thumbprints'), ArrayType(['string'])]
    private ?array $prevThumbprints;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsShouldTrustEmailVerifiedConnectionEnum> $shouldTrustEmailVerifiedConnection
     */
    #[JsonProperty('should_trust_email_verified_connection')]
    private ?string $shouldTrustEmailVerifiedConnection;

    /**
     * @var ?string $signInEndpoint Passive Requestor (WS-Fed) sign-in endpoint discovered from metadata or provided explicitly.
     */
    #[JsonProperty('signInEndpoint')]
    private ?string $signInEndpoint;

    /**
     * @var ?string $tenantDomain Tenant domain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string> $thumbprints Array of certificate thumbprints (SHA-128/SHA-256/SHA-512 hex hashes) for validating SAML signatures. Used with WS-Federation protocol. Maximum 20 thumbprints. Each thumbprint must be a hexadecimal string.
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @var ?string $userIdAttribute Custom ADFS claim to use as the unique user identifier. When provided, this attribute is prepended to the default user_id mapping list with highest priority. Accepts a string (single ADFS claim name).
     */
    #[JsonProperty('user_id_attribute')]
    private ?string $userIdAttribute;

    /**
     * @param array{
     *   adfsServer?: ?string,
     *   certRolloverNotification?: ?DateTime,
     *   domainAliases?: ?array<string>,
     *   entityId?: ?string,
     *   fedMetadataXml?: ?string,
     *   iconUrl?: ?string,
     *   nonPersistentAttrs?: ?array<string>,
     *   prevThumbprints?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsSetUserRootAttributesEnum>,
     *   shouldTrustEmailVerifiedConnection?: ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsShouldTrustEmailVerifiedConnectionEnum>,
     *   signInEndpoint?: ?string,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, mixed>,
     *   userIdAttribute?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->adfsServer = $values['adfsServer'] ?? null;
        $this->certRolloverNotification = $values['certRolloverNotification'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
        $this->fedMetadataXml = $values['fedMetadataXml'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->prevThumbprints = $values['prevThumbprints'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->shouldTrustEmailVerifiedConnection = $values['shouldTrustEmailVerifiedConnection'] ?? null;
        $this->signInEndpoint = $values['signInEndpoint'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->userIdAttribute = $values['userIdAttribute'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAdfsServer(): ?string
    {
        return $this->adfsServer;
    }

    /**
     * @param ?string $value
     */
    public function setAdfsServer(?string $value = null): self
    {
        $this->adfsServer = $value;
        $this->_setField('adfsServer');
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
     * @return ?string
     */
    public function getFedMetadataXml(): ?string
    {
        return $this->fedMetadataXml;
    }

    /**
     * @param ?string $value
     */
    public function setFedMetadataXml(?string $value = null): self
    {
        $this->fedMetadataXml = $value;
        $this->_setField('fedMetadataXml');
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
     * @return ?array<string>
     */
    public function getPrevThumbprints(): ?array
    {
        return $this->prevThumbprints;
    }

    /**
     * @param ?array<string> $value
     */
    public function setPrevThumbprints(?array $value = null): self
    {
        $this->prevThumbprints = $value;
        $this->_setField('prevThumbprints');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsShouldTrustEmailVerifiedConnectionEnum>
     */
    public function getShouldTrustEmailVerifiedConnection(): ?string
    {
        return $this->shouldTrustEmailVerifiedConnection;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionUpdatedObject4OptionsShouldTrustEmailVerifiedConnectionEnum> $value
     */
    public function setShouldTrustEmailVerifiedConnection(?string $value = null): self
    {
        $this->shouldTrustEmailVerifiedConnection = $value;
        $this->_setField('shouldTrustEmailVerifiedConnection');
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
