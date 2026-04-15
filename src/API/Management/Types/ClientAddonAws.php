<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * AWS addon configuration.
 */
class ClientAddonAws extends JsonSerializableType
{
    /**
     * @var ?string $principal AWS principal ARN, e.g. `arn:aws:iam::010616021751:saml-provider/idpname`
     */
    #[JsonProperty('principal')]
    private ?string $principal;

    /**
     * @var ?string $role AWS role ARN, e.g. `arn:aws:iam::010616021751:role/foo`
     */
    #[JsonProperty('role')]
    private ?string $role;

    /**
     * @var ?int $lifetimeInSeconds AWS token lifetime in seconds
     */
    #[JsonProperty('lifetime_in_seconds')]
    private ?int $lifetimeInSeconds;

    /**
     * @param array{
     *   principal?: ?string,
     *   role?: ?string,
     *   lifetimeInSeconds?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->principal = $values['principal'] ?? null;
        $this->role = $values['role'] ?? null;
        $this->lifetimeInSeconds = $values['lifetimeInSeconds'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    /**
     * @param ?string $value
     */
    public function setPrincipal(?string $value = null): self
    {
        $this->principal = $value;
        $this->_setField('principal');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param ?string $value
     */
    public function setRole(?string $value = null): self
    {
        $this->role = $value;
        $this->_setField('role');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLifetimeInSeconds(): ?int
    {
        return $this->lifetimeInSeconds;
    }

    /**
     * @param ?int $value
     */
    public function setLifetimeInSeconds(?int $value = null): self
    {
        $this->lifetimeInSeconds = $value;
        $this->_setField('lifetimeInSeconds');
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
