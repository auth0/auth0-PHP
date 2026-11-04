<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PortalClientSecretPostRequest extends JsonSerializableType
{
    /**
     * @var value-of<PortalClientSecretPostRequestTokenEndpointAuthMethod> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private string $tokenEndpointAuthMethod;

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
     * @param array{
     *   tokenEndpointAuthMethod: value-of<PortalClientSecretPostRequestTokenEndpointAuthMethod>,
     *   clientId: string,
     *   clientSecret: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'];
        $this->clientId = $values['clientId'];
        $this->clientSecret = $values['clientSecret'];
    }

    /**
     * @return value-of<PortalClientSecretPostRequestTokenEndpointAuthMethod>
     */
    public function getTokenEndpointAuthMethod(): string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param value-of<PortalClientSecretPostRequestTokenEndpointAuthMethod> $value
     */
    public function setTokenEndpointAuthMethod(string $value): self
    {
        $this->tokenEndpointAuthMethod = $value;
        $this->_setField('tokenEndpointAuthMethod');
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
