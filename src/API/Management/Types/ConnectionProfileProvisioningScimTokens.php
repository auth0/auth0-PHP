<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * SCIM token settings for connections created from this profile.
 */
class ConnectionProfileProvisioningScimTokens extends JsonSerializableType
{
    /**
     * @var array<value-of<ConnectionProfileProvisioningScimTokenScopeEnum>> $scopes
     */
    #[JsonProperty('scopes'), ArrayType(['string'])]
    private array $scopes;

    /**
     * @var ?int $defaultExpiry
     */
    #[JsonProperty('default_expiry')]
    private ?int $defaultExpiry;

    /**
     * @var ?int $maxAllowedExpiry
     */
    #[JsonProperty('max_allowed_expiry')]
    private ?int $maxAllowedExpiry;

    /**
     * @param array{
     *   scopes: array<value-of<ConnectionProfileProvisioningScimTokenScopeEnum>>,
     *   defaultExpiry?: ?int,
     *   maxAllowedExpiry?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->scopes = $values['scopes'];
        $this->defaultExpiry = $values['defaultExpiry'] ?? null;
        $this->maxAllowedExpiry = $values['maxAllowedExpiry'] ?? null;
    }

    /**
     * @return array<value-of<ConnectionProfileProvisioningScimTokenScopeEnum>>
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param array<value-of<ConnectionProfileProvisioningScimTokenScopeEnum>> $value
     */
    public function setScopes(array $value): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getDefaultExpiry(): ?int
    {
        return $this->defaultExpiry;
    }

    /**
     * @param ?int $value
     */
    public function setDefaultExpiry(?int $value = null): self
    {
        $this->defaultExpiry = $value;
        $this->_setField('defaultExpiry');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxAllowedExpiry(): ?int
    {
        return $this->maxAllowedExpiry;
    }

    /**
     * @param ?int $value
     */
    public function setMaxAllowedExpiry(?int $value = null): self
    {
        $this->maxAllowedExpiry = $value;
        $this->_setField('maxAllowedExpiry');
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
