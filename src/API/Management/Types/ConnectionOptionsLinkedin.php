<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'linkedin' connection
 */
class ConnectionOptionsLinkedin extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $clientId
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $clientSecret
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?array<string> $freeformScopes
     */
    #[JsonProperty('freeform_scopes'), ArrayType(['string'])]
    private ?array $freeformScopes;

    /**
     * @var ?array<string> $scope
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private ?array $scope;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?int $strategyVersion The strategy_version property determines which LinkedIn API version and OAuth scopes are used for authentication. Version 1 uses legacy scopes (r_basicprofile, r_fullprofile, r_network), Version 2 uses updated scopes (r_liteprofile, r_basicprofile), and Version 3 uses OpenID Connect scopes (profile, email, openid). If not specified, the connection defaults to Version 3.
     */
    #[JsonProperty('strategy_version')]
    private ?int $strategyVersion;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $basicProfile Request the LinkedIn lite profile scope (r_liteprofile) to retrieve member id, localized first/last name, and profile picture. Off by default.
     */
    #[JsonProperty('basic_profile')]
    private ?bool $basicProfile;

    /**
     * @var ?bool $email Request the email address scope (r_emailaddress) to return the member's primary email. Off by default.
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?bool $fullProfile Request the legacy full profile scope (r_fullprofile) for extended attributes. Deprecated by LinkedIn; use only if enabled for your app. Off by default.
     */
    #[JsonProperty('full_profile')]
    private ?bool $fullProfile;

    /**
     * @var ?bool $network Request legacy network access (first-degree connections). Deprecated by LinkedIn and typically unavailable to new apps. Off by default.
     */
    #[JsonProperty('network')]
    private ?bool $network;

    /**
     * @var ?bool $openid Request OpenID Connect authentication support (openid scope). When enabled, the connection will request the 'openid' scope from LinkedIn, allowing the use of OpenID Connect flows for authentication and enabling the issuance of ID tokens. This is off by default and should only be enabled if your LinkedIn application is configured for OpenID Connect.
     */
    #[JsonProperty('openid')]
    private ?bool $openid;

    /**
     * @var ?bool $profile Always-true flag that ensures the LinkedIn profile scope (r_basicprofile/r_liteprofile/profile) is requested.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   strategyVersion?: ?int,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   basicProfile?: ?bool,
     *   email?: ?bool,
     *   fullProfile?: ?bool,
     *   network?: ?bool,
     *   openid?: ?bool,
     *   profile?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->strategyVersion = $values['strategyVersion'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->basicProfile = $values['basicProfile'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->fullProfile = $values['fullProfile'] ?? null;
        $this->network = $values['network'] ?? null;
        $this->openid = $values['openid'] ?? null;
        $this->profile = $values['profile'] ?? null;
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
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param ?string $value
     */
    public function setClientSecret(?string $value = null): self
    {
        $this->clientSecret = $value;
        $this->_setField('clientSecret');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getFreeformScopes(): ?array
    {
        return $this->freeformScopes;
    }

    /**
     * @param ?array<string> $value
     */
    public function setFreeformScopes(?array $value = null): self
    {
        $this->freeformScopes = $value;
        $this->_setField('freeformScopes');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getScope(): ?array
    {
        return $this->scope;
    }

    /**
     * @param ?array<string> $value
     */
    public function setScope(?array $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
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
     * @return ?int
     */
    public function getStrategyVersion(): ?int
    {
        return $this->strategyVersion;
    }

    /**
     * @param ?int $value
     */
    public function setStrategyVersion(?int $value = null): self
    {
        $this->strategyVersion = $value;
        $this->_setField('strategyVersion');
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
     * @return ?bool
     */
    public function getBasicProfile(): ?bool
    {
        return $this->basicProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setBasicProfile(?bool $value = null): self
    {
        $this->basicProfile = $value;
        $this->_setField('basicProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getEmail(): ?bool
    {
        return $this->email;
    }

    /**
     * @param ?bool $value
     */
    public function setEmail(?bool $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getFullProfile(): ?bool
    {
        return $this->fullProfile;
    }

    /**
     * @param ?bool $value
     */
    public function setFullProfile(?bool $value = null): self
    {
        $this->fullProfile = $value;
        $this->_setField('fullProfile');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNetwork(): ?bool
    {
        return $this->network;
    }

    /**
     * @param ?bool $value
     */
    public function setNetwork(?bool $value = null): self
    {
        $this->network = $value;
        $this->_setField('network');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getOpenid(): ?bool
    {
        return $this->openid;
    }

    /**
     * @param ?bool $value
     */
    public function setOpenid(?bool $value = null): self
    {
        $this->openid = $value;
        $this->_setField('openid');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getProfile(): ?bool
    {
        return $this->profile;
    }

    /**
     * @param ?bool $value
     */
    public function setProfile(?bool $value = null): self
    {
        $this->profile = $value;
        $this->_setField('profile');
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
