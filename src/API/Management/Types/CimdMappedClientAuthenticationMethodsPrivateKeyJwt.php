<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Private Key JWT authentication configuration
 */
class CimdMappedClientAuthenticationMethodsPrivateKeyJwt extends JsonSerializableType
{
    /**
     * @var array<CimdMappedPrivateKeyJwtCredential> $credentials Credentials derived from the JWKS document
     */
    #[JsonProperty('credentials'), ArrayType([CimdMappedPrivateKeyJwtCredential::class])]
    private array $credentials;

    /**
     * @param array{
     *   credentials: array<CimdMappedPrivateKeyJwtCredential>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
    }

    /**
     * @return array<CimdMappedPrivateKeyJwtCredential>
     */
    public function getCredentials(): array
    {
        return $this->credentials;
    }

    /**
     * @param array<CimdMappedPrivateKeyJwtCredential> $value
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
