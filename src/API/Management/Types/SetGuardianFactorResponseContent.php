<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetGuardianFactorResponseContent extends JsonSerializableType
{
    /**
     * @var bool $enabled Whether this factor is enabled (true) or disabled (false).
     */
    #[JsonProperty('enabled')]
    private bool $enabled;

    /**
     * @param array{
     *   enabled: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enabled = $values['enabled'];
    }

    /**
     * @return bool
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $value
     */
    public function setEnabled(bool $value): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
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
