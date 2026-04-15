<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Options for the 'apple' connection
 */
class ConnectionOptionsApple extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $appSecret Apple App Secret (must be a PEM)
     */
    #[JsonProperty('app_secret')]
    private ?string $appSecret;

    /**
     * @var ?string $clientId Apple Services ID
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?bool $email User has the option to obfuscate the email with Apple's relay service
     */
    #[JsonProperty('email')]
    private ?bool $email;

    /**
     * @var ?array<string> $freeformScopes Array of freeform scopes
     */
    #[JsonProperty('freeform_scopes'), ArrayType(['string'])]
    private ?array $freeformScopes;

    /**
     * @var ?string $kid Apple Key ID
     */
    #[JsonProperty('kid')]
    private ?string $kid;

    /**
     * @var ?bool $name Whether to request name from Apple
     */
    #[JsonProperty('name')]
    private ?bool $name;

    /**
     * @var ?string $scope Space separated list of scopes
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?value-of<ConnectionSetUserRootAttributesEnum> $setUserRootAttributes
     */
    #[JsonProperty('set_user_root_attributes')]
    private ?string $setUserRootAttributes;

    /**
     * @var ?string $teamId Apple Team ID
     */
    #[JsonProperty('team_id')]
    private ?string $teamId;

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
     *   appSecret?: ?string,
     *   clientId?: ?string,
     *   email?: ?bool,
     *   freeformScopes?: ?array<string>,
     *   kid?: ?string,
     *   name?: ?bool,
     *   scope?: ?string,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   teamId?: ?string,
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
        $this->appSecret = $values['appSecret'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->kid = $values['kid'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->teamId = $values['teamId'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAppSecret(): ?string
    {
        return $this->appSecret;
    }

    /**
     * @param ?string $value
     */
    public function setAppSecret(?string $value = null): self
    {
        $this->appSecret = $value;
        $this->_setField('appSecret');
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
     * @return ?string
     */
    public function getKid(): ?string
    {
        return $this->kid;
    }

    /**
     * @param ?string $value
     */
    public function setKid(?string $value = null): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getName(): ?bool
    {
        return $this->name;
    }

    /**
     * @param ?bool $value
     */
    public function setName(?bool $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
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
     * @return ?string
     */
    public function getTeamId(): ?string
    {
        return $this->teamId;
    }

    /**
     * @param ?string $value
     */
    public function setTeamId(?string $value = null): self
    {
        $this->teamId = $value;
        $this->_setField('teamId');
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
