<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'oauth2' connection
 */
class ConnectionOptionsOAuth2 extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?array<string, string> $authParams
     */
    #[JsonProperty('authParams'), ArrayType(['string' => 'string'])]
    private ?array $authParams;

    /**
     * @var ?array<string, string> $authParamsMap
     */
    #[JsonProperty('authParamsMap'), ArrayType(['string' => 'string'])]
    private ?array $authParamsMap;

    /**
     * @var ?string $authorizationUrl
     */
    #[JsonProperty('authorizationURL')]
    private ?string $authorizationUrl;

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
     * @var ?array<string, string> $customHeaders
     */
    #[JsonProperty('customHeaders'), ArrayType(['string' => 'string'])]
    private ?array $customHeaders;

    /**
     * @var ?array<string, string> $fieldsMap
     */
    #[JsonProperty('fieldsMap'), ArrayType(['string' => 'string'])]
    private ?array $fieldsMap;

    /**
     * @var ?string $iconUrl
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?string $logoutUrl
     */
    #[JsonProperty('logoutUrl')]
    private ?string $logoutUrl;

    /**
     * @var ?bool $pkceEnabled When true, enables Proof Key for Code Exchange (PKCE) for the authorization code flow. PKCE provides additional security by preventing authorization code interception attacks.
     */
    #[JsonProperty('pkce_enabled')]
    private ?bool $pkceEnabled;

    /**
     * @var (
     *    string
     *   |array<string>
     * )|null $scope
     */
    #[JsonProperty('scope'), Union('string', ['string'], 'null')]
    private string|array|null $scope;

    /**
     * @var ?ConnectionScriptsOAuth2 $scripts
     */
    #[JsonProperty('scripts')]
    private ?ConnectionScriptsOAuth2 $scripts;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $tokenUrl
     */
    #[JsonProperty('tokenURL')]
    private ?string $tokenUrl;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $useOauthSpecScope When true, uses space-delimited scopes (per OAuth 2.0 spec) instead of comma-delimited when calling the identity provider's authorization endpoint. Only relevant when using the connection_scope parameter. See https://auth0.com/docs/authenticate/identity-providers/adding-scopes-for-an-external-idp#pass-scopes-to-authorize-endpoint
     */
    #[JsonProperty('useOauthSpecScope')]
    private ?bool $useOauthSpecScope;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   authParams?: ?array<string, string>,
     *   authParamsMap?: ?array<string, string>,
     *   authorizationUrl?: ?string,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   customHeaders?: ?array<string, string>,
     *   fieldsMap?: ?array<string, string>,
     *   iconUrl?: ?string,
     *   logoutUrl?: ?string,
     *   pkceEnabled?: ?bool,
     *   scope?: (
     *    string
     *   |array<string>
     * )|null,
     *   scripts?: ?ConnectionScriptsOAuth2,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   tokenUrl?: ?string,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   useOauthSpecScope?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->authParams = $values['authParams'] ?? null;
        $this->authParamsMap = $values['authParamsMap'] ?? null;
        $this->authorizationUrl = $values['authorizationUrl'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->customHeaders = $values['customHeaders'] ?? null;
        $this->fieldsMap = $values['fieldsMap'] ?? null;
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->logoutUrl = $values['logoutUrl'] ?? null;
        $this->pkceEnabled = $values['pkceEnabled'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->scripts = $values['scripts'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->tokenUrl = $values['tokenUrl'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->useOauthSpecScope = $values['useOauthSpecScope'] ?? null;
    }

    /**
     * @return ?array<string, string>
     */
    public function getAuthParams(): ?array
    {
        return $this->authParams;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setAuthParams(?array $value = null): self
    {
        $this->authParams = $value;
        $this->_setField('authParams');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getAuthParamsMap(): ?array
    {
        return $this->authParamsMap;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setAuthParamsMap(?array $value = null): self
    {
        $this->authParamsMap = $value;
        $this->_setField('authParamsMap');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAuthorizationUrl(): ?string
    {
        return $this->authorizationUrl;
    }

    /**
     * @param ?string $value
     */
    public function setAuthorizationUrl(?string $value = null): self
    {
        $this->authorizationUrl = $value;
        $this->_setField('authorizationUrl');
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
     * @return ?array<string, string>
     */
    public function getCustomHeaders(): ?array
    {
        return $this->customHeaders;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setCustomHeaders(?array $value = null): self
    {
        $this->customHeaders = $value;
        $this->_setField('customHeaders');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getFieldsMap(): ?array
    {
        return $this->fieldsMap;
    }

    /**
     * @param ?array<string, string> $value
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
     * @return ?string
     */
    public function getLogoutUrl(): ?string
    {
        return $this->logoutUrl;
    }

    /**
     * @param ?string $value
     */
    public function setLogoutUrl(?string $value = null): self
    {
        $this->logoutUrl = $value;
        $this->_setField('logoutUrl');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPkceEnabled(): ?bool
    {
        return $this->pkceEnabled;
    }

    /**
     * @param ?bool $value
     */
    public function setPkceEnabled(?bool $value = null): self
    {
        $this->pkceEnabled = $value;
        $this->_setField('pkceEnabled');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string>
     * )|null
     */
    public function getScope(): string|array|null
    {
        return $this->scope;
    }

    /**
     * @param (
     *    string
     *   |array<string>
     * )|null $value
     */
    public function setScope(string|array|null $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?ConnectionScriptsOAuth2
     */
    public function getScripts(): ?ConnectionScriptsOAuth2
    {
        return $this->scripts;
    }

    /**
     * @param ?ConnectionScriptsOAuth2 $value
     */
    public function setScripts(?ConnectionScriptsOAuth2 $value = null): self
    {
        $this->scripts = $value;
        $this->_setField('scripts');
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
    public function getTokenUrl(): ?string
    {
        return $this->tokenUrl;
    }

    /**
     * @param ?string $value
     */
    public function setTokenUrl(?string $value = null): self
    {
        $this->tokenUrl = $value;
        $this->_setField('tokenUrl');
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
    public function getUseOauthSpecScope(): ?bool
    {
        return $this->useOauthSpecScope;
    }

    /**
     * @param ?bool $value
     */
    public function setUseOauthSpecScope(?bool $value = null): self
    {
        $this->useOauthSpecScope = $value;
        $this->_setField('useOauthSpecScope');
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
