<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Defines `tls_client_auth` client authentication method. If the property is defined, the client is configured to use CA-based mTLS authentication method.
 */
class ClientCreateAuthenticationMethodTlsClientAuth extends JsonSerializableType
{
    /**
     * @var array<CertificateSubjectDnCredential> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([CertificateSubjectDnCredential::class])]
    private array $credentials;

    /**
     * @param array{
     *   credentials: array<CertificateSubjectDnCredential>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
    }

    /**
     * @return array<CertificateSubjectDnCredential>
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array<CertificateSubjectDnCredential> $value
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
