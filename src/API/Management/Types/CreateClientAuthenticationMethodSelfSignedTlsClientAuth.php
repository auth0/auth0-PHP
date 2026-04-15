<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Defines `self_signed_tls_client_auth` client authentication method. If the property is defined, the client is configured to use mTLS authentication method utilizing self-signed certificate.
 */
class CreateClientAuthenticationMethodSelfSignedTlsClientAuth extends JsonSerializableType
{
    /**
     * @var array<X509CertificateCredential> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([X509CertificateCredential::class])]
    private array $credentials;

    /**
     * @param array{
     *   credentials: array<X509CertificateCredential>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
    }

    /**
     * @return array<X509CertificateCredential>
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array<X509CertificateCredential> $value
     */
    public function setCredentials(array $value): self
    {
        $this->credentials = $value;
        $this->_setField('credentials');
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
