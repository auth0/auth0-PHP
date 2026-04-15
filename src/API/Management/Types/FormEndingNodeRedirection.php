<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormEndingNodeRedirection extends JsonSerializableType
{
    /**
     * @var ?int $delay
     */
    #[JsonProperty('delay')]
    private ?int $delay;

    /**
     * @var string $target
     */
    #[JsonProperty('target')]
    private string $target;

    /**
     * @param array{
     *   target: string,
     *   delay?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->delay = $values['delay'] ?? null;
        $this->target = $values['target'];
    }

    /**
     * @return ?int
     */
    public function getDelay(): ?int
    {
        return $this->delay;
    }

    /**
     * @param ?int $value
     */
    public function setDelay(?int $value = null): self
    {
        $this->delay = $value;
        $this->_setField('delay');
        return $this;
    }

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $value
     */
    public function setTarget(string $value): self
    {
        $this->target = $value;
        $this->_setField('target');
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
