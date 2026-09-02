<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Options for the 'ad' connection
 */
class EventStreamCloudEventConnectionUpdatedObject5Options extends JsonSerializableType
{
    /**
     * @var ?string $agentIp IP address of the AD connector agent used to validate that authentication requests originate from the corporate network for Kerberos authentication  (managed by the AD Connector agent).
     */
    #[JsonProperty('agentIP')]
    private ?string $agentIp;

    /**
     * @var ?bool $agentMode When enabled, allows direct username/password authentication through the AD connector agent instead of WS-Federation protocol (managed by the AD Connector agent).
     */
    #[JsonProperty('agentMode')]
    private ?bool $agentMode;

    /**
     * @var ?string $agentVersion Version identifier of the installed AD connector agent software (managed by the AD Connector agent).
     */
    #[JsonProperty('agentVersion')]
    private ?string $agentVersion;

    /**
     * @var ?bool $bruteForceProtection Enables Auth0's brute force protection to prevent credential stuffing attacks. When enabled, blocks suspicious login attempts from specific IP addresses after repeated failures.
     */
    #[JsonProperty('brute_force_protection')]
    private ?bool $bruteForceProtection;

    /**
     * @var ?bool $certAuth Enables client SSL certificate authentication for the AD connector, requiring HTTPS on the sign-in endpoint
     */
    #[JsonProperty('certAuth')]
    private ?bool $certAuth;

    /**
     * @var ?array<string> $certs Array of X.509 certificates in PEM format used for validating SAML signatures from the AD identity provider (managed by the AD Connector agent).
     */
    #[JsonProperty('certs'), ArrayType(['string'])]
    private ?array $certs;

    /**
     * @var ?bool $disableCache When enabled, disables caching of AD connector authentication results to ensure real-time validation against the directory
     */
    #[JsonProperty('disable_cache')]
    private ?bool $disableCache;

    /**
     * @var ?bool $disableSelfServiceChangePassword When enabled, hides the 'Forgot Password' link on login pages to prevent users from initiating self-service password resets
     */
    #[JsonProperty('disable_self_service_change_password')]
    private ?bool $disableSelfServiceChangePassword;

    /**
     * @var ?array<string> $domainAliases List of domain names that can be used with identifier-first authentication flow to route users to this AD connection; each domain must be a valid DNS name up to 256 characters
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?string $iconUrl https url of the icon to be shown
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?array<string> $ips Array of IP address ranges in CIDR notation used to determine if authentication requests originate from the corporate network for Kerberos or certificate authentication.
     */
    #[JsonProperty('ips'), ArrayType(['string'])]
    private ?array $ips;

    /**
     * @var ?bool $kerberos Enables Windows Integrated Authentication (Kerberos) for seamless SSO when users authenticate from within the corporate network IP ranges
     */
    #[JsonProperty('kerberos')]
    private ?bool $kerberos;

    /**
     * @var ?bool $kerberosOnly When true, restricts the connection to Kerberos-only authentication, disallowing username/password fallback.
     */
    #[JsonProperty('kerberos_only')]
    private ?bool $kerberosOnly;

    /**
     * @var ?array<string> $nonPersistentAttrs An array of user fields that should not be stored in the Auth0 database (https://auth0.com/docs/security/data-security/denylist)
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionUpdatedObject5OptionsSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $signInEndpoint The sign-in endpoint type for the AD-LDAP connector agent (managed by the AD Connector agent).
     */
    #[JsonProperty('signInEndpoint')]
    private ?string $signInEndpoint;

    /**
     * @var ?string $tenantDomain Primary AD domain hint used for HRD and discovery.
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string> $thumbprints Array of certificate SHA-1 thumbprints for validating signatures. Managed by Auth0 when using the AD Connector agent.
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, mixed> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => 'mixed'])]
    private ?array $upstreamParams;

    /**
     * @param array{
     *   agentIp?: ?string,
     *   agentMode?: ?bool,
     *   agentVersion?: ?string,
     *   bruteForceProtection?: ?bool,
     *   certAuth?: ?bool,
     *   certs?: ?array<string>,
     *   disableCache?: ?bool,
     *   disableSelfServiceChangePassword?: ?bool,
     *   domainAliases?: ?array<string>,
     *   iconUrl?: ?string,
     *   ips?: ?array<string>,
     *   kerberos?: ?bool,
     *   kerberosOnly?: ?bool,
     *   nonPersistentAttrs?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<EventStreamCloudEventConnectionUpdatedObject5OptionsSetUserRootAttributesEnum>,
     *   signInEndpoint?: ?string,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->agentIp = $values['agentIp'] ?? null;
        $this->agentMode = $values['agentMode'] ?? null;
        $this->agentVersion = $values['agentVersion'] ?? null;
        $this->bruteForceProtection = $values['bruteForceProtection'] ?? null;
        $this->certAuth = $values['certAuth'] ?? null;
        $this->certs = $values['certs'] ?? null;
        $this->disableCache = $values['disableCache'] ?? null;
        $this->disableSelfServiceChangePassword = $values['disableSelfServiceChangePassword'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->ips = $values['ips'] ?? null;
        $this->kerberos = $values['kerberos'] ?? null;
        $this->kerberosOnly = $values['kerberosOnly'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->signInEndpoint = $values['signInEndpoint'] ?? null;
        $this->tenantDomain = $values['tenantDomain'] ?? null;
        $this->thumbprints = $values['thumbprints'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAgentIp(): ?string
    {
        return $this->agentIp;
    }

    /**
     * @param ?string $value
     */
    public function setAgentIp(?string $value = null): self
    {
        $this->agentIp = $value;
        $this->_setField('agentIp');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAgentMode(): ?bool
    {
        return $this->agentMode;
    }

    /**
     * @param ?bool $value
     */
    public function setAgentMode(?bool $value = null): self
    {
        $this->agentMode = $value;
        $this->_setField('agentMode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAgentVersion(): ?string
    {
        return $this->agentVersion;
    }

    /**
     * @param ?string $value
     */
    public function setAgentVersion(?string $value = null): self
    {
        $this->agentVersion = $value;
        $this->_setField('agentVersion');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getBruteForceProtection(): ?bool
    {
        return $this->bruteForceProtection;
    }

    /**
     * @param ?bool $value
     */
    public function setBruteForceProtection(?bool $value = null): self
    {
        $this->bruteForceProtection = $value;
        $this->_setField('bruteForceProtection');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCertAuth(): ?bool
    {
        return $this->certAuth;
    }

    /**
     * @param ?bool $value
     */
    public function setCertAuth(?bool $value = null): self
    {
        $this->certAuth = $value;
        $this->_setField('certAuth');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getCerts(): ?array
    {
        return $this->certs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setCerts(?array $value = null): self
    {
        $this->certs = $value;
        $this->_setField('certs');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableCache(): ?bool
    {
        return $this->disableCache;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableCache(?bool $value = null): self
    {
        $this->disableCache = $value;
        $this->_setField('disableCache');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSelfServiceChangePassword(): ?bool
    {
        return $this->disableSelfServiceChangePassword;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSelfServiceChangePassword(?bool $value = null): self
    {
        $this->disableSelfServiceChangePassword = $value;
        $this->_setField('disableSelfServiceChangePassword');
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
    public function getIps(): ?array
    {
        return $this->ips;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIps(?array $value = null): self
    {
        $this->ips = $value;
        $this->_setField('ips');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getKerberos(): ?bool
    {
        return $this->kerberos;
    }

    /**
     * @param ?bool $value
     */
    public function setKerberos(?bool $value = null): self
    {
        $this->kerberos = $value;
        $this->_setField('kerberos');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getKerberosOnly(): ?bool
    {
        return $this->kerberosOnly;
    }

    /**
     * @param ?bool $value
     */
    public function setKerberosOnly(?bool $value = null): self
    {
        $this->kerberosOnly = $value;
        $this->_setField('kerberosOnly');
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
     * @return ?value-of<EventStreamCloudEventConnectionUpdatedObject5OptionsSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionUpdatedObject5OptionsSetUserRootAttributesEnum> $value
     */
    public function setSetUserRootAttributes(?string $value = null): self
    {
        $this->setUserRootAttributes = $value;
        $this->_setField('setUserRootAttributes');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
