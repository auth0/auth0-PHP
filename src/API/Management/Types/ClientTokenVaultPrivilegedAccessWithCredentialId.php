<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Settings for Token Vault Privileged Access.
 */
class ClientTokenVaultPrivilegedAccessWithCredentialId extends JsonSerializableType
{
    /**
     * @var array<CredentialId> $credentials
     */
    #[JsonProperty('credentials'), ArrayType([CredentialId::class])]
    private array $credentials;

    /**
     * @var ?array<string> $ipAllowlist
     */
    #[JsonProperty('ip_allowlist'), ArrayType(['string'])]
    private ?array $ipAllowlist;

    /**
     * @param array{
     *   credentials: array<CredentialId>,
     *   ipAllowlist?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->credentials = $values['credentials'];
        $this->ipAllowlist = $values['ipAllowlist'] ?? null;
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
     * @return ?array<string>
     */
    public function getIpAllowlist(): ?array
    {
        return $this->ipAllowlist;
    }

    /**
     * @param ?array<string> $value
     */
    public function setIpAllowlist(?array $value = null): self
    {
        $this->ipAllowlist = $value;
        $this->_setField('ipAllowlist');
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
