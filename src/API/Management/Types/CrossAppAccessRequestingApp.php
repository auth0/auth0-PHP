<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configure the connection to be used as a Requesting Application for Cross App Access.
 */
class CrossAppAccessRequestingApp extends JsonSerializableType
{
    /**
     * @var bool $active Set to `true` to enable the connection as a Requesting Application for Cross App Access. On `oidc` connections this requires `options.type` to be `back_channel`. Setting `false` is always accepted, so the role can be turned off even if the tenant or connection no longer supports it.
     */
    #[JsonProperty('active')]
    private bool $active;

    /**
     * @param array{
     *   active: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->active = $values['active'];
    }

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $value
     */
    public function setActive(bool $value): self
    {
        $this->active = $value;
        $this->_setField('active');
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
