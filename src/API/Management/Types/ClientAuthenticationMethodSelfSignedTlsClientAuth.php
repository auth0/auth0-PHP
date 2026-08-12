<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Defines `self_signed_tls_client_auth` client authentication method. If the property is defined, the client is configured to use mTLS authentication method utilizing self-signed certificate.
 */
class ClientAuthenticationMethodSelfSignedTlsClientAuth extends JsonSerializableType
{
    /**
     * @var array<CredentialId> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([CredentialId::class])]
    private array $credentials;

    /**
     * @param array{
     *   credentials: array<CredentialId>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
    }

    /**
     * @return array<CredentialId>
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array<CredentialId> $value
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
