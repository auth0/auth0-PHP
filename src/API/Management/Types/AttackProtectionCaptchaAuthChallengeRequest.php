<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AttackProtectionCaptchaAuthChallengeRequest extends JsonSerializableType
{
    /**
     * @var bool $failOpen Whether the auth challenge should fail open.
     */
    #[JsonProperty('fail_open')]
    private bool $failOpen;

    /**
     * @param array{
     *   failOpen: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->failOpen = $values['failOpen'];
    }

    /**
     * @return bool
     */
    public function getFailOpen(): bool
    {
        return $this->failOpen;
    }

    /**
     * @param bool $value
     */
    public function setFailOpen(bool $value): self
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
