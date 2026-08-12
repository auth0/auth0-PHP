<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The token quota configuration
 */
class TokenQuotaClientCredentials extends JsonSerializableType
{
    /**
     * @var ?bool $enforce If enabled, the quota will be enforced and requests in excess of the quota will fail. If disabled, the quota will not be enforced, but notifications for requests exceeding the quota will be available in logs.
     */
    #[JsonProperty('enforce')]
    private ?bool $enforce;

    /**
     * @var ?int $perDay Maximum number of issued tokens per day
     */
    #[JsonProperty('per_day')]
    private ?int $perDay;

    /**
     * @var ?int $perHour Maximum number of issued tokens per hour
     */
    #[JsonProperty('per_hour')]
    private ?int $perHour;

    /**
     * @param array{
     *   enforce?: ?bool,
     *   perDay?: ?int,
     *   perHour?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enforce = $values['enforce'] ?? null;
        $this->perDay = $values['perDay'] ?? null;
        $this->perHour = $values['perHour'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnforce(): ?bool
    {
        return $this->enforce;
    }

    /**
     * @param ?bool $value
     */
    public function setEnforce(?bool $value = null): self
    {
        $this->enforce = $value;
        $this->_setField('enforce');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPerDay(): ?int
    {
        return $this->perDay;
    }

    /**
     * @param ?int $value
     */
    public function setPerDay(?int $value = null): self
    {
        $this->perDay = $value;
        $this->_setField('perDay');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPerHour(): ?int
    {
        return $this->perHour;
    }

    /**
     * @param ?int $value
     */
    public function setPerHour(?int $value = null): self
    {
        $this->perHour = $value;
        $this->_setField('perHour');
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
