<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Defines `private_key_jwt` client authentication method. If this property is defined, the client is enabled to use the Private Key JWT authentication method.
 */
class ClientCreateAuthenticationMethodPrivateKeyJwt extends JsonSerializableType
{
    /**
     * @var array<PublicKeyCredential> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([PublicKeyCredential::class])]
    private array $credentials;

    /**
     * @param array{
     *   credentials: array<PublicKeyCredential>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
    }

    /**
     * @return array<PublicKeyCredential>
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array<PublicKeyCredential> $value
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
