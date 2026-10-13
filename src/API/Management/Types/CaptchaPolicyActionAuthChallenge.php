<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Auth Challenge CAPTCHA provider configuration.
 */
class CaptchaPolicyActionAuthChallenge extends JsonSerializableType
{
    /**
     * @var ?bool $failOpen Whether to allow access when the challenge provider is unavailable.
     */
    #[JsonProperty('fail_open')]
    private ?bool $failOpen;

    /**
     * @param array{
     *   failOpen?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->failOpen = $values['failOpen'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getFailOpen(): ?bool
    {
        return $this->failOpen;
    }

    /**
     * @param ?bool $value
     */
    public function setFailOpen(?bool $value = null): self
    {
        $this->failOpen = $value;
        $this->_setField('failOpen');
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
