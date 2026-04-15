<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the salesforce family of connections (salesforce, salesforce-sandbox, salesforce-community)
 */
class ConnectionOptionsSalesforce extends JsonSerializableType
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
     * @var ?bool $profile When enabled, requests the Salesforce profile scope to retrieve basic user information including user_id, organization_id, username, display_name, email, status, photos, and URLs.
     */
    #[JsonProperty('profile')]
    private ?bool $profile;

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
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   profile?: ?bool,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
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
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
