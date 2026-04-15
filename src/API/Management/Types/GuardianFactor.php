<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GuardianFactor extends JsonSerializableType
{
    /**
     * @var bool $enabled Whether this factor is enabled (true) or disabled (false).
     */
    #[JsonProperty('enabled')]
    private bool $enabled;

    /**
     * @var ?bool $trialExpired Whether trial limits have been exceeded.
     */
    #[JsonProperty('trial_expired')]
    private ?bool $trialExpired;

    /**
     * @var ?value-of<GuardianFactorNameEnum> $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @param array{
     *   enabled: bool,
     *   trialExpired?: ?bool,
     *   name?: ?value-of<GuardianFactorNameEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enabled = $values['enabled'];
        $this->trialExpired = $values['trialExpired'] ?? null;
        $this->name = $values['name'] ?? null;
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $value
     */
    public function setEnabled(bool $value): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTrialExpired(): ?bool
    {
        return $this->trialExpired;
    }

    /**
     * @param ?bool $value
     */
    public function setTrialExpired(?bool $value = null): self
    {
        $this->trialExpired = $value;
        $this->_setField('trialExpired');
        return $this;
    }

    /**
     * @return ?value-of<GuardianFactorNameEnum>
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?value-of<GuardianFactorNameEnum> $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
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
