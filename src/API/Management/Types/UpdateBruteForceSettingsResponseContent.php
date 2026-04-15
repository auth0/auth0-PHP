<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateBruteForceSettingsResponseContent extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether or not brute force attack protections are active.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * Action to take when a brute force protection threshold is violated.
     *         Possible values: <code>block</code>, <code>user_notification</code>.
     *
     * @var ?array<value-of<BruteForceProtectionShieldsEnum>> $shields
     */
    #[JsonProperty('shields'), ArrayType(['string'])]
    private ?array $shields;

    /**
     * @var ?array<string> $allowlist List of trusted IP addresses that will not have attack protection enforced against them.
     */
    #[JsonProperty('allowlist'), ArrayType(['string'])]
    private ?array $allowlist;

    /**
     * @var ?value-of<BruteForceProtectionModeEnum> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @var ?int $maxAttempts Maximum number of unsuccessful attempts.
     */
    #[JsonProperty('max_attempts')]
    private ?int $maxAttempts;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   shields?: ?array<value-of<BruteForceProtectionShieldsEnum>>,
     *   allowlist?: ?array<string>,
     *   mode?: ?value-of<BruteForceProtectionModeEnum>,
     *   maxAttempts?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->shields = $values['shields'] ?? null;
        $this->allowlist = $values['allowlist'] ?? null;
        $this->mode = $values['mode'] ?? null;
        $this->maxAttempts = $values['maxAttempts'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?array<value-of<BruteForceProtectionShieldsEnum>>
     */
    public function getShields(): ?array
    {
        return $this->shields;
    }

    /**
     * @param ?array<value-of<BruteForceProtectionShieldsEnum>> $value
     */
    public function setShields(?array $value = null): self
    {
        $this->shields = $value;
        $this->_setField('shields');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getAllowlist(): ?array
    {
        return $this->allowlist;
    }

    /**
     * @param ?array<string> $value
     */
    public function setAllowlist(?array $value = null): self
    {
        $this->allowlist = $value;
        $this->_setField('allowlist');
        return $this;
    }

    /**
     * @return ?value-of<BruteForceProtectionModeEnum>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<BruteForceProtectionModeEnum> $value
     */
    public function setMode(?string $value = null): self
    {
        $this->mode = $value;
        $this->_setField('mode');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxAttempts(): ?int
    {
        return $this->maxAttempts;
    }

    /**
     * @param ?int $value
     */
    public function setMaxAttempts(?int $value = null): self
    {
        $this->maxAttempts = $value;
        $this->_setField('maxAttempts');
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
