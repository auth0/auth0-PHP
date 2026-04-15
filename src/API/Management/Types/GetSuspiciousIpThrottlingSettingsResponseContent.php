<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetSuspiciousIpThrottlingSettingsResponseContent extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether or not suspicious IP throttling attack protections are active.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * Action to take when a suspicious IP throttling threshold is violated.
     *           Possible values: <code>block</code>, <code>admin_notification</code>.
     *
     * @var ?array<value-of<SuspiciousIpThrottlingShieldsEnum>> $shields
     */
    #[JsonProperty('shields'), ArrayType(['string'])]
    private ?array $shields;

    /**
     * @var ?array<string> $allowlist
     */
    #[JsonProperty('allowlist'), ArrayType(['string'])]
    private ?array $allowlist;

    /**
     * @var ?SuspiciousIpThrottlingStage $stage
     */
    #[JsonProperty('stage')]
    private ?SuspiciousIpThrottlingStage $stage;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   shields?: ?array<value-of<SuspiciousIpThrottlingShieldsEnum>>,
     *   allowlist?: ?array<string>,
     *   stage?: ?SuspiciousIpThrottlingStage,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->shields = $values['shields'] ?? null;
        $this->allowlist = $values['allowlist'] ?? null;
        $this->stage = $values['stage'] ?? null;
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
     * @return ?array<value-of<SuspiciousIpThrottlingShieldsEnum>>
     */
    public function getShields(): ?array
    {
        return $this->shields;
    }

    /**
     * @param ?array<value-of<SuspiciousIpThrottlingShieldsEnum>> $value
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
     * @return ?SuspiciousIpThrottlingStage
     */
    public function getStage(): ?SuspiciousIpThrottlingStage
    {
        return $this->stage;
    }

    /**
     * @param ?SuspiciousIpThrottlingStage $value
     */
    public function setStage(?SuspiciousIpThrottlingStage $value = null): self
    {
        $this->stage = $value;
        $this->_setField('stage');
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
