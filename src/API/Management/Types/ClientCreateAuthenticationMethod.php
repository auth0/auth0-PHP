<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Defines client authentication methods.
 */
class ClientCreateAuthenticationMethod extends JsonSerializableType
{
    /**
     * @var ?ClientCreateAuthenticationMethodPrivateKeyJwt $privateKeyJwt
     */
    #[JsonProperty('private_key_jwt')]
    private ?ClientCreateAuthenticationMethodPrivateKeyJwt $privateKeyJwt;

    /**
     * @var ?ClientCreateAuthenticationMethodTlsClientAuth $tlsClientAuth
     */
    #[JsonProperty('tls_client_auth')]
    private ?ClientCreateAuthenticationMethodTlsClientAuth $tlsClientAuth;

    /**
     * @var ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth $selfSignedTlsClientAuth
     */
    #[JsonProperty('self_signed_tls_client_auth')]
    private ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth $selfSignedTlsClientAuth;

    /**
     * @param array{
     *   privateKeyJwt?: ?ClientCreateAuthenticationMethodPrivateKeyJwt,
     *   tlsClientAuth?: ?ClientCreateAuthenticationMethodTlsClientAuth,
     *   selfSignedTlsClientAuth?: ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->privateKeyJwt = $values['privateKeyJwt'] ?? null;
        $this->tlsClientAuth = $values['tlsClientAuth'] ?? null;
        $this->selfSignedTlsClientAuth = $values['selfSignedTlsClientAuth'] ?? null;
    }

    /**
     * @return ?ClientCreateAuthenticationMethodPrivateKeyJwt
     */
    public function getPrivateKeyJwt(): ?ClientCreateAuthenticationMethodPrivateKeyJwt
    {
        return $this->privateKeyJwt;
    }

    /**
     * @param ?ClientCreateAuthenticationMethodPrivateKeyJwt $value
     */
    public function setPrivateKeyJwt(?ClientCreateAuthenticationMethodPrivateKeyJwt $value = null): self
    {
        $this->privateKeyJwt = $value;
        $this->_setField('privateKeyJwt');
        return $this;
    }

    /**
     * @return ?ClientCreateAuthenticationMethodTlsClientAuth
     */
    public function getTlsClientAuth(): ?ClientCreateAuthenticationMethodTlsClientAuth
    {
        return $this->tlsClientAuth;
    }

    /**
     * @param ?ClientCreateAuthenticationMethodTlsClientAuth $value
     */
    public function setTlsClientAuth(?ClientCreateAuthenticationMethodTlsClientAuth $value = null): self
    {
        $this->tlsClientAuth = $value;
        $this->_setField('tlsClientAuth');
        return $this;
    }

    /**
     * @return ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth
     */
    public function getSelfSignedTlsClientAuth(): ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth
    {
        return $this->selfSignedTlsClientAuth;
    }

    /**
     * @param ?CreateClientAuthenticationMethodSelfSignedTlsClientAuth $value
     */
    public function setSelfSignedTlsClientAuth(?CreateClientAuthenticationMethodSelfSignedTlsClientAuth $value = null): self
    {
        $this->selfSignedTlsClientAuth = $value;
        $this->_setField('selfSignedTlsClientAuth');
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
