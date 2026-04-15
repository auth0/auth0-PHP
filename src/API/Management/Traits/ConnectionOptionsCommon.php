<?php

namespace Auth0\SDK\API\Management\Traits;

use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Common attributes for connection options including non-persistent attributes and Cross App Access
 *
 * @property ?array<string> $nonPersistentAttrs
 */
trait ConnectionOptionsCommon
{
    /**
     * @var ?array<string> $nonPersistentAttrs
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @return ?array<string>
     */
    public function getNonPersistentAttrs(): ?array
    {
        return $this->nonPersistentAttrs;
    }

    /**
     * @param ?array<string> $value
     */
    public function setNonPersistentAttrs(?array $value = null): self
    {
        $this->nonPersistentAttrs = $value;
        $this->_setField('nonPersistentAttrs');
        return $this;
    }
}
