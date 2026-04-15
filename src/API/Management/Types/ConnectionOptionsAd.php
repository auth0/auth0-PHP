<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'ad' connection
 */
class ConnectionOptionsAd extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $agentIp
     */
    #[JsonProperty('agentIP')]
    private ?string $agentIp;

    /**
     * @var ?bool $agentMode
     */
    #[JsonProperty('agentMode')]
    private ?bool $agentMode;

    /**
     * @var ?string $agentVersion
     */
    #[JsonProperty('agentVersion')]
    private ?string $agentVersion;

    /**
     * @var ?bool $bruteForceProtection
     */
    #[JsonProperty('brute_force_protection')]
    private ?bool $bruteForceProtection;

    /**
     * @var ?bool $certAuth Enables client SSL certificate authentication for the AD connector, requiring HTTPS on the sign-in endpoint
     */
    #[JsonProperty('certAuth')]
    private ?bool $certAuth;

    /**
     * @var ?array<string> $certs
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
     * @var ?array<string> $domainAliases
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?array<string> $ips
     */
    #[JsonProperty('ips'), ArrayType(['string'])]
    private ?array $ips;

    /**
     * @var ?bool $kerberos Enables Windows Integrated Authentication (Kerberos) for seamless SSO when users authenticate from within the corporate network IP ranges
     */
    #[JsonProperty('kerberos')]
    private ?bool $kerberos;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $signInEndpoint
     */
    #[JsonProperty('signInEndpoint')]
    private ?string $signInEndpoint;

    /**
     * @var ?string $tenantDomain
     */
    #[JsonProperty('tenant_domain')]
    private ?string $tenantDomain;

    /**
     * @var ?array<string> $thumbprints
     */
    #[JsonProperty('thumbprints'), ArrayType(['string'])]
    private ?array $thumbprints;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
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
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   signInEndpoint?: ?string,
     *   tenantDomain?: ?string,
     *   thumbprints?: ?array<string>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
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
     * @return ?value-of<ConnectionSetUserRootAttributesEnum>
     */
    public function getSetUserRootAttributes(): ?string
    {
        return $this->setUserRootAttributes;
    }

    /**
     * @param ?value-of<ConnectionSetUserRootAttributesEnum> $value
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
     * @return ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>
     */
    public function getUpstreamParams(): ?array
    {
        return $this->upstreamParams;
    }

    /**
     * @param ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $value
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
