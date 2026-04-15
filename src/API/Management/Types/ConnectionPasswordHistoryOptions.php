<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for password history policy
 */
class ConnectionPasswordHistoryOptions extends JsonSerializableType
{
    /**
     * @var bool $enable
     */
    #[JsonProperty('enable')]
    private bool $enable;

    /**
     * @var ?int $size
     */
    #[JsonProperty('size')]
    private ?int $size;

    /**
     * @param array{
     *   enable: bool,
     *   size?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enable = $values['enable'];
        $this->size = $values['size'] ?? null;
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
     * @return ?int
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param ?int $value
     */
    public function setSize(?int $value = null): self
    {
        $this->size = $value;
        $this->_setField('size');
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
