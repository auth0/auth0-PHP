<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectionHttpOauthClientCredentialsSetup extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectionSetupTypeOauthClientCredentialsEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $clientId
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var string $clientSecret
     */
    #[JsonProperty('client_secret')]
    private string $clientSecret;

    /**
     * @var string $tokenEndpoint
     */
    #[JsonProperty('token_endpoint')]
    private string $tokenEndpoint;

    /**
     * @var ?string $audience
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $resource
     */
    #[JsonProperty('resource')]
    private ?string $resource;

    /**
     * @var ?string $scope
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectionSetupTypeOauthClientCredentialsEnum>,
     *   clientId: string,
     *   clientSecret: string,
     *   tokenEndpoint: string,
     *   audience?: ?string,
     *   resource?: ?string,
     *   scope?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'];
        $this->tokenEndpoint = $values['tokenEndpoint'];
        $this->audience = $values['audience'] ?? null;
        $this->resource = $values['resource'] ?? null;
        $this->scope = $values['scope'] ?? null;
    }

    /**
     * @return value-of<FlowsVaultConnectionSetupTypeOauthClientCredentialsEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectionSetupTypeOauthClientCredentialsEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $value
     */
    public function setClientId(string $value): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $value
     */
    public function setClientSecret(string $value): self
    {
        $this->clientSecret = $value;
        $this->_setField('clientSecret');
        return $this;
    }

    /**
     * @return string
     */
    public function getTokenEndpoint(): string
    {
        return $this->tokenEndpoint;
    }

    /**
     * @param string $value
     */
    public function setTokenEndpoint(string $value): self
    {
        $this->tokenEndpoint = $value;
        $this->_setField('tokenEndpoint');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getResource(): ?string
    {
        return $this->resource;
    }

    /**
     * @param ?string $value
     */
    public function setResource(?string $value = null): self
    {
        $this->resource = $value;
        $this->_setField('resource');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
