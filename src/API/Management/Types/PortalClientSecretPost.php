<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PortalClientSecretPost extends JsonSerializableType
{
    /**
     * @var value-of<PortalClientSecretPostTokenEndpointAuthMethod> $tokenEndpointAuthMethod
     */
    #[JsonProperty('token_endpoint_auth_method')]
    private string $tokenEndpointAuthMethod;

    /**
     * @var string $clientId
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @param array{
     *   tokenEndpointAuthMethod: value-of<PortalClientSecretPostTokenEndpointAuthMethod>,
     *   clientId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tokenEndpointAuthMethod = $values['tokenEndpointAuthMethod'];
        $this->clientId = $values['clientId'];
    }

    /**
     * @return value-of<PortalClientSecretPostTokenEndpointAuthMethod>
     */
    public function getTokenEndpointAuthMethod(): string
    {
        return $this->tokenEndpointAuthMethod;
    }

    /**
     * @param value-of<PortalClientSecretPostTokenEndpointAuthMethod> $value
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
    public function __toString(): string
    {
        return $this->toJson();
    }
}
