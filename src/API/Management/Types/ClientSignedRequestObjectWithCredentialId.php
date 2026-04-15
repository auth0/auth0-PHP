<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * JWT-secured Authorization Requests (JAR) settings.
 */
class ClientSignedRequestObjectWithCredentialId extends JsonSerializableType
{
    /**
     * @var ?bool $required Indicates whether the JAR requests are mandatory
     */
    #[JsonProperty('required')]
    private ?bool $required;

    /**
     * @var ?array<CredentialId> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([CredentialId::class])]
    private ?array $credentials;

    /**
     * @param array{
     *   required?: ?bool,
     *   credentials?: ?array<CredentialId>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->required = $values['required'] ?? null;
        $this->credentials = $values['credentials'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getRequired(): ?bool
    {
        return $this->required;
    }

    /**
     * @param ?bool $value
     */
    public function setRequired(?bool $value = null): self
    {
        $this->required = $value;
        $this->_setField('required');
        return $this;
    }

    /**
     * @return ?array<CredentialId>
     */
    public function getCredentials(): ?array
    {
        return $this->credentials;
    }

    /**
     * @param ?array<CredentialId> $value
     */
    public function setCredentials(?array $value = null): self
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
