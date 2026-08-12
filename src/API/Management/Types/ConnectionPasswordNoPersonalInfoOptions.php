<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for personal info in passwords policy
 */
class ConnectionPasswordNoPersonalInfoOptions extends JsonSerializableType
{
    /**
     * @var bool $enable
     */
    #[JsonProperty('enable')]
    private bool $enable;

    /**
     * @param array{
     *   enable: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enable = $values['enable'];
    }

    /**
     * @return bool
     */
    public function getEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @param bool $value
     */
    public function setEnable(bool $value): self
    {
        $this->enable = $value;
        $this->_setField('enable');
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
