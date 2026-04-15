<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Defines client authentication methods.
 */
class ClientAuthenticationMethod extends JsonSerializableType
{
    /**
     * @var ?ClientAuthenticationMethodPrivateKeyJwt $privateKeyJwt
     */
    #[JsonProperty('private_key_jwt')]
    private ?ClientAuthenticationMethodPrivateKeyJwt $privateKeyJwt;

    /**
     * @var ?ClientAuthenticationMethodTlsClientAuth $tlsClientAuth
     */
    #[JsonProperty('tls_client_auth')]
    private ?ClientAuthenticationMethodTlsClientAuth $tlsClientAuth;

    /**
     * @var ?ClientAuthenticationMethodSelfSignedTlsClientAuth $selfSignedTlsClientAuth
     */
    #[JsonProperty('self_signed_tls_client_auth')]
    private ?ClientAuthenticationMethodSelfSignedTlsClientAuth $selfSignedTlsClientAuth;

    /**
     * @param array{
     *   privateKeyJwt?: ?ClientAuthenticationMethodPrivateKeyJwt,
     *   tlsClientAuth?: ?ClientAuthenticationMethodTlsClientAuth,
     *   selfSignedTlsClientAuth?: ?ClientAuthenticationMethodSelfSignedTlsClientAuth,
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
     * @return ?ClientAuthenticationMethodPrivateKeyJwt
     */
    public function getPrivateKeyJwt(): ?ClientAuthenticationMethodPrivateKeyJwt
    {
        return $this->privateKeyJwt;
    }

    /**
     * @param ?ClientAuthenticationMethodPrivateKeyJwt $value
     */
    public function setPrivateKeyJwt(?ClientAuthenticationMethodPrivateKeyJwt $value = null): self
    {
        $this->privateKeyJwt = $value;
        $this->_setField('privateKeyJwt');
        return $this;
    }

    /**
     * @return ?ClientAuthenticationMethodTlsClientAuth
     */
    public function getTlsClientAuth(): ?ClientAuthenticationMethodTlsClientAuth
    {
        return $this->tlsClientAuth;
    }

    /**
     * @param ?ClientAuthenticationMethodTlsClientAuth $value
     */
    public function setTlsClientAuth(?ClientAuthenticationMethodTlsClientAuth $value = null): self
    {
        $this->tlsClientAuth = $value;
        $this->_setField('tlsClientAuth');
        return $this;
    }

    /**
     * @return ?ClientAuthenticationMethodSelfSignedTlsClientAuth
     */
    public function getSelfSignedTlsClientAuth(): ?ClientAuthenticationMethodSelfSignedTlsClientAuth
    {
        return $this->selfSignedTlsClientAuth;
    }

    /**
     * @param ?ClientAuthenticationMethodSelfSignedTlsClientAuth $value
     */
    public function setSelfSignedTlsClientAuth(?ClientAuthenticationMethodSelfSignedTlsClientAuth $value = null): self
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
