<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Password history policy configuration to prevent password reuse
 */
class ConnectionPasswordOptionsHistory extends JsonSerializableType
{
    /**
     * @var ?bool $active Enables password history checking to prevent users from reusing recent passwords
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?int $size Number of previous passwords to remember and prevent reuse (1-24)
     */
    #[JsonProperty('size')]
    private ?int $size;

    /**
     * @param array{
     *   active?: ?bool,
     *   size?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->size = $values['size'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
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
