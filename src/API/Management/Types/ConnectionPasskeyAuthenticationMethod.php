<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Passkey authentication enablement
 */
class ConnectionPasskeyAuthenticationMethod extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Determines whether passkeys are enabled
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?value-of<ConnectionSignupBehaviorEnum> $signupBehavior Specifies the signup behavior for passkey authentication
     */
    #[JsonProperty('signup_behavior')]
    private ?string $signupBehavior;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   signupBehavior?: ?value-of<ConnectionSignupBehaviorEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->signupBehavior = $values['signupBehavior'] ?? null;
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
     * @return ?value-of<ConnectionSignupBehaviorEnum>
     */
    public function getSignupBehavior(): ?string
    {
        return $this->signupBehavior;
    }

    /**
     * @param ?value-of<ConnectionSignupBehaviorEnum> $value
     */
    public function setSignupBehavior(?string $value = null): self
    {
        $this->signupBehavior = $value;
        $this->_setField('signupBehavior');
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
