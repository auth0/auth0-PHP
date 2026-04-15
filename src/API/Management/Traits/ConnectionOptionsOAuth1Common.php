<?php

namespace Auth0\SDK\API\Management\Traits;

use Auth0\SDK\API\Management\Types\ConnectionSetUserRootAttributesEnum;
use Auth0\SDK\API\Management\Types\ConnectionUpstreamAlias;
use Auth0\SDK\API\Management\Types\ConnectionUpstreamValue;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * @property ?string $clientId
 * @property ?string $clientSecret
 * @property ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
 * @property ?array<string, (
 *    ConnectionUpstreamAlias
 *   |ConnectionUpstreamValue
 * )|null> $upstreamParams
 */
trait ConnectionOptionsOAuth1Common
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $clientId OAuth 1.0 client identifier issued by the identity provider during application registration. This value identifies your Auth0 connection to the identity provider.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $clientSecret OAuth 1.0 client secret issued by the identity provider during application registration. Used to authenticate your Auth0 connection when signing requests and exchanging request tokens and verifiers for access tokens. May be null for public clients.
     */
    #[JsonProperty('client_secret')]
    private ?string $clientSecret;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

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
}
