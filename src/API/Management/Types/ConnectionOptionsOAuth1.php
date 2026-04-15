<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'oauth1' connection
 */
class ConnectionOptionsOAuth1 extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $accessTokenUrl
     */
    #[JsonProperty('accessTokenURL')]
    private ?string $accessTokenUrl;

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
     * @var ?string $requestTokenUrl
     */
    #[JsonProperty('requestTokenURL')]
    private ?string $requestTokenUrl;

    /**
     * @var ?ConnectionScriptsOAuth1 $scripts
     */
    #[JsonProperty('scripts')]
    private ?ConnectionScriptsOAuth1 $scripts;

    /**
     * @var ?value-of<ConnectionSignatureMethodOAuth1> $signatureMethod
     */
    #[JsonProperty('signatureMethod')]
    private ?string $signatureMethod;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?string $userAuthorizationUrl
     */
    #[JsonProperty('userAuthorizationURL')]
    private ?string $userAuthorizationUrl;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   accessTokenUrl?: ?string,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   requestTokenUrl?: ?string,
     *   scripts?: ?ConnectionScriptsOAuth1,
     *   signatureMethod?: ?value-of<ConnectionSignatureMethodOAuth1>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   userAuthorizationUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->accessTokenUrl = $values['accessTokenUrl'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->requestTokenUrl = $values['requestTokenUrl'] ?? null;
        $this->scripts = $values['scripts'] ?? null;
        $this->signatureMethod = $values['signatureMethod'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->userAuthorizationUrl = $values['userAuthorizationUrl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAccessTokenUrl(): ?string
    {
        return $this->accessTokenUrl;
    }

    /**
     * @param ?string $value
     */
    public function setAccessTokenUrl(?string $value = null): self
    {
        $this->accessTokenUrl = $value;
        $this->_setField('accessTokenUrl');
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
     * @return ?string
     */
    public function getRequestTokenUrl(): ?string
    {
        return $this->requestTokenUrl;
    }

    /**
     * @param ?string $value
     */
    public function setRequestTokenUrl(?string $value = null): self
    {
        $this->requestTokenUrl = $value;
        $this->_setField('requestTokenUrl');
        return $this;
    }

    /**
     * @return ?ConnectionScriptsOAuth1
     */
    public function getScripts(): ?ConnectionScriptsOAuth1
    {
        return $this->scripts;
    }

    /**
     * @param ?ConnectionScriptsOAuth1 $value
     */
    public function setScripts(?ConnectionScriptsOAuth1 $value = null): self
    {
        $this->scripts = $value;
        $this->_setField('scripts');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionSignatureMethodOAuth1>
     */
    public function getSignatureMethod(): ?string
    {
        return $this->signatureMethod;
    }

    /**
     * @param ?value-of<ConnectionSignatureMethodOAuth1> $value
     */
    public function setSignatureMethod(?string $value = null): self
    {
        $this->signatureMethod = $value;
        $this->_setField('signatureMethod');
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
     * @return ?string
     */
    public function getUserAuthorizationUrl(): ?string
    {
        return $this->userAuthorizationUrl;
    }

    /**
     * @param ?string $value
     */
    public function setUserAuthorizationUrl(?string $value = null): self
    {
        $this->userAuthorizationUrl = $value;
        $this->_setField('userAuthorizationUrl');
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
