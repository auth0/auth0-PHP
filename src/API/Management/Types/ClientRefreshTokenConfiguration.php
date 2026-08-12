<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Refresh token configuration
 */
class ClientRefreshTokenConfiguration extends JsonSerializableType
{
    /**
     * @var value-of<RefreshTokenRotationTypeEnum> $rotationType
     */
    #[JsonProperty('rotation_type')]
    private string $rotationType;

    /**
     * @var value-of<RefreshTokenExpirationTypeEnum> $expirationType
     */
    #[JsonProperty('expiration_type')]
    private string $expirationType;

    /**
     * @var ?int $leeway Period in seconds where the previous refresh token can be exchanged without triggering breach detection
     */
    #[JsonProperty('leeway')]
    private ?int $leeway;

    /**
     * @var ?int $tokenLifetime Period (in seconds) for which refresh tokens will remain valid
     */
    #[JsonProperty('token_lifetime')]
    private ?int $tokenLifetime;

    /**
     * @var ?bool $infiniteTokenLifetime Prevents tokens from having a set lifetime when `true` (takes precedence over `token_lifetime` values)
     */
    #[JsonProperty('infinite_token_lifetime')]
    private ?bool $infiniteTokenLifetime;

    /**
     * @var ?int $idleTokenLifetime Period (in seconds) for which refresh tokens will remain valid without use
     */
    #[JsonProperty('idle_token_lifetime')]
    private ?int $idleTokenLifetime;

    /**
     * @var ?bool $infiniteIdleTokenLifetime Prevents tokens from expiring without use when `true` (takes precedence over `idle_token_lifetime` values)
     */
    #[JsonProperty('infinite_idle_token_lifetime')]
    private ?bool $infiniteIdleTokenLifetime;

    /**
     * @var ?array<ClientRefreshTokenPolicy> $policies A collection of policies governing multi-resource refresh token exchange (MRRT), defining how refresh tokens can be used across different resource servers
     */
    #[JsonProperty('policies'), ArrayType([ClientRefreshTokenPolicy::class])]
    private ?array $policies;

    /**
     * @param array{
     *   rotationType: value-of<RefreshTokenRotationTypeEnum>,
     *   expirationType: value-of<RefreshTokenExpirationTypeEnum>,
     *   leeway?: ?int,
     *   tokenLifetime?: ?int,
     *   infiniteTokenLifetime?: ?bool,
     *   idleTokenLifetime?: ?int,
     *   infiniteIdleTokenLifetime?: ?bool,
     *   policies?: ?array<ClientRefreshTokenPolicy>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->rotationType = $values['rotationType'];
        $this->expirationType = $values['expirationType'];
        $this->leeway = $values['leeway'] ?? null;
        $this->tokenLifetime = $values['tokenLifetime'] ?? null;
        $this->infiniteTokenLifetime = $values['infiniteTokenLifetime'] ?? null;
        $this->idleTokenLifetime = $values['idleTokenLifetime'] ?? null;
        $this->infiniteIdleTokenLifetime = $values['infiniteIdleTokenLifetime'] ?? null;
        $this->policies = $values['policies'] ?? null;
    }

    /**
     * @return value-of<RefreshTokenRotationTypeEnum>
     */
    public function getRotationType(): string
    {
        return $this->rotationType;
    }

    /**
     * @param value-of<RefreshTokenRotationTypeEnum> $value
     */
    public function setRotationType(string $value): self
    {
        $this->rotationType = $value;
        $this->_setField('rotationType');
        return $this;
    }

    /**
     * @return value-of<RefreshTokenExpirationTypeEnum>
     */
    public function getExpirationType(): string
    {
        return $this->expirationType;
    }

    /**
     * @param value-of<RefreshTokenExpirationTypeEnum> $value
     */
    public function setExpirationType(string $value): self
    {
        $this->expirationType = $value;
        $this->_setField('expirationType');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLeeway(): ?int
    {
        return $this->leeway;
    }

    /**
     * @param ?int $value
     */
    public function setLeeway(?int $value = null): self
    {
        $this->leeway = $value;
        $this->_setField('leeway');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTokenLifetime(): ?int
    {
        return $this->tokenLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setTokenLifetime(?int $value = null): self
    {
        $this->tokenLifetime = $value;
        $this->_setField('tokenLifetime');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getInfiniteTokenLifetime(): ?bool
    {
        return $this->infiniteTokenLifetime;
    }

    /**
     * @param ?bool $value
     */
    public function setInfiniteTokenLifetime(?bool $value = null): self
    {
        $this->infiniteTokenLifetime = $value;
        $this->_setField('infiniteTokenLifetime');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getIdleTokenLifetime(): ?int
    {
        return $this->idleTokenLifetime;
    }

    /**
     * @param ?int $value
     */
    public function setIdleTokenLifetime(?int $value = null): self
    {
        $this->idleTokenLifetime = $value;
        $this->_setField('idleTokenLifetime');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getInfiniteIdleTokenLifetime(): ?bool
    {
        return $this->infiniteIdleTokenLifetime;
    }

    /**
     * @param ?bool $value
     */
    public function setInfiniteIdleTokenLifetime(?bool $value = null): self
    {
        $this->infiniteIdleTokenLifetime = $value;
        $this->_setField('infiniteIdleTokenLifetime');
        return $this;
    }

    /**
     * @return ?array<ClientRefreshTokenPolicy>
     */
    public function getPolicies(): ?array
    {
        return $this->policies;
    }

    /**
     * @param ?array<ClientRefreshTokenPolicy> $value
     */
    public function setPolicies(?array $value = null): self
    {
        $this->policies = $value;
        $this->_setField('policies');
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
