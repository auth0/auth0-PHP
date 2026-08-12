<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Session cookie configuration
 */
class SessionCookieSchema extends JsonSerializableType
{
    /**
     * @var value-of<SessionCookieModeEnum> $mode
     */
    #[JsonProperty('mode')]
    private string $mode;

    /**
     * @param array{
     *   mode: value-of<SessionCookieModeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mode = $values['mode'];
    }

    /**
     * @return value-of<SessionCookieModeEnum>
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param value-of<SessionCookieModeEnum> $value
     */
    public function setMode(string $value): self
    {
        $this->mode = $value;
        $this->_setField('mode');
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
