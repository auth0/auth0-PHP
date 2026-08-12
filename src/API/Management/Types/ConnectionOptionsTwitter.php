<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'twitter' connection
 */
class ConnectionOptionsTwitter extends JsonSerializableType
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
     * @var ?value-of<ConnectionOptionsProtocolEnumTwitter> $protocol
     */
    #[JsonProperty('protocol')]
    private ?string $protocol;

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
     * @var ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null> $upstreamParams
     */
    #[JsonProperty('upstream_params'), ArrayType(['string' => new Union(new Union(ConnectionUpstreamAlias::class, ConnectionUpstreamValue::class), 'null')])]
    private ?array $upstreamParams;

    /**
     * @var ?bool $offlineAccess Request long-lived refresh tokens so your app can act on behalf of users even when they’re not actively signed in. Typical Twitter use case: keeping a background service synced without forcing users to reauthorize every session.
     */
    #[JsonProperty('offline_access')]
    private ?bool $offlineAccess;

    /**
     * @var ?bool $profile Pull account profile metadata such as display name, bio, location, and URL so downstream apps can prefill or personalize user experiences.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

    /**
     * @var ?bool $tweetRead Allow the application to read a user’s public and protected Tweets—required for timelines, analytics, or moderation workflows.
     */
    #[JsonProperty('tweet_read')]
    private ?bool $tweetRead;

    /**
     * @var ?bool $usersRead Read non-Tweet user information (e.g., followers/following, account settings) to power relationship graphs or audience insights.
     */
    #[JsonProperty('users_read')]
    private ?bool $usersRead;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   protocol?: ?value-of<ConnectionOptionsProtocolEnumTwitter>,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   offlineAccess?: ?bool,
     *   profile?: ?bool,
     *   tweetRead?: ?bool,
     *   usersRead?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->protocol = $values['protocol'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->offlineAccess = $values['offlineAccess'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->tweetRead = $values['tweetRead'] ?? null;
        $this->usersRead = $values['usersRead'] ?? null;
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
     * @return ?value-of<ConnectionOptionsProtocolEnumTwitter>
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    /**
     * @param ?value-of<ConnectionOptionsProtocolEnumTwitter> $value
     */
    public function setProtocol(?string $value = null): self
    {
        $this->protocol = $value;
        $this->_setField('protocol');
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
    public function getOfflineAccess(): ?bool
    {
        return $this->offlineAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setOfflineAccess(?bool $value = null): self
    {
        $this->offlineAccess = $value;
        $this->_setField('offlineAccess');
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
     * @return ?bool
     */
    public function getTweetRead(): ?bool
    {
        return $this->tweetRead;
    }

    /**
     * @param ?bool $value
     */
    public function setTweetRead(?bool $value = null): self
    {
        $this->tweetRead = $value;
        $this->_setField('tweetRead');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUsersRead(): ?bool
    {
        return $this->usersRead;
    }

    /**
     * @param ?bool $value
     */
    public function setUsersRead(?bool $value = null): self
    {
        $this->usersRead = $value;
        $this->_setField('usersRead');
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
