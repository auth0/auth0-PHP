<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Client authentication methods derived from the JWKS document
 */
class CimdMappedClientAuthenticationMethods extends JsonSerializableType
{
    /**
     * @var ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt $privateKeyJwt
     */
    #[JsonProperty('private_key_jwt')]
    private ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt $privateKeyJwt;

    /**
     * @param array{
     *   privateKeyJwt?: ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->privateKeyJwt = $values['privateKeyJwt'] ?? null;
    }

    /**
     * @return ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt
     */
    public function getPrivateKeyJwt(): ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt
    {
        return $this->privateKeyJwt;
    }

    /**
     * @param ?CimdMappedClientAuthenticationMethodsPrivateKeyJwt $value
     */
    public function setPrivateKeyJwt(?CimdMappedClientAuthenticationMethodsPrivateKeyJwt $value = null): self
    {
        $this->privateKeyJwt = $value;
        $this->_setField('privateKeyJwt');
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
