<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Common attributes for connection options including non-persistent attributes and Cross App Access
 */
class ConnectionOptionsCommon extends JsonSerializableType
{
    /**
     * @var ?array<string> $nonPersistentAttrs
     */
    #[JsonProperty('non_persistent_attrs'), ArrayType(['string'])]
    private ?array $nonPersistentAttrs;

    /**
     * @param array{
     *   nonPersistentAttrs?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
    }

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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
