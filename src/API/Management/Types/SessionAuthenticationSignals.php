<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Details about authentication signals obtained during the login flow
 */
class SessionAuthenticationSignals extends JsonSerializableType
{
    /**
     * @var ?array<SessionAuthenticationSignal> $methods Contains the authentication methods a user has completed during their session
     */
    #[JsonProperty('methods'), ArrayType([SessionAuthenticationSignal::class])]
    private ?array $methods;

    /**
     * @param array{
     *   methods?: ?array<SessionAuthenticationSignal>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->methods = $values['methods'] ?? null;
    }

    /**
     * @return ?array<SessionAuthenticationSignal>
     */
    public function getMethods(): ?array
    {
        return $this->methods;
    }

    /**
     * @param ?array<SessionAuthenticationSignal> $value
     */
    public function setMethods(?array $value = null): self
    {
        $this->methods = $value;
        $this->_setField('methods');
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
