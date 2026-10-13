<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Default idle refresh token lifetime, in seconds, applied to matched clients.
 */
class ClientProfileRefreshTokenIdleTokenLifetime extends JsonSerializableType
{
    /**
     * @var ?int $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?int $defaultValue;

    /**
     * @param array{
     *   defaultValue?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getDefaultValue(): ?int
    {
        return $this->defaultValue;
    }

    /**
     * @param ?int $value
     */
    public function setDefaultValue(?int $value = null): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
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
