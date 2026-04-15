<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration options that apply before every login attempt.
 */
class SuspiciousIpThrottlingPreLoginStage extends JsonSerializableType
{
    /**
     * @var ?int $maxAttempts Total number of attempts allowed per day.
     */
    #[JsonProperty('max_attempts')]
    private ?int $maxAttempts;

    /**
     * @var ?int $rate Interval of time, given in milliseconds, at which new attempts are granted.
     */
    #[JsonProperty('rate')]
    private ?int $rate;

    /**
     * @param array{
     *   maxAttempts?: ?int,
     *   rate?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->maxAttempts = $values['maxAttempts'] ?? null;
        $this->rate = $values['rate'] ?? null;
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
     * @return ?int
     */
    public function getRate(): ?int
    {
        return $this->rate;
    }

    /**
     * @param ?int $value
     */
    public function setRate(?int $value = null): self
    {
        $this->rate = $value;
        $this->_setField('rate');
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
