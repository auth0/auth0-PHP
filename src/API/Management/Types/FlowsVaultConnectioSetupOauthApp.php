<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupOauthApp extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeOauthAppEnum> $type
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
     * @var string $domain
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @var ?string $audience
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeOauthAppEnum>,
     *   clientId: string,
     *   clientSecret: string,
     *   domain: string,
     *   audience?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'];
        $this->domain = $values['domain'];
        $this->audience = $values['audience'] ?? null;
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeOauthAppEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeOauthAppEnum> $value
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
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $value
     */
    public function setDomain(string $value): self
    {
        $this->domain = $value;
        $this->_setField('domain');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
