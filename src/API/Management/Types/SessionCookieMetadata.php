<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * [Private Early Access] Session cookie configuration.
 */
class SessionCookieMetadata extends JsonSerializableType
{
    /**
     * @var ?value-of<SessionCookieMetadataModeEnum> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @param array{
     *   mode?: ?value-of<SessionCookieMetadataModeEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mode = $values['mode'] ?? null;
    }

    /**
     * @return ?value-of<SessionCookieMetadataModeEnum>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<SessionCookieMetadataModeEnum> $value
     */
    public function setMode(?string $value = null): self
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
