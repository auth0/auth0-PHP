<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetScimConfigurationDefaultMappingResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ScimMappingItem> $mapping The mapping between auth0 and SCIM
     */
    #[JsonProperty('mapping'), ArrayType([ScimMappingItem::class])]
    private ?array $mapping;

    /**
     * @param array{
     *   mapping?: ?array<ScimMappingItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mapping = $values['mapping'] ?? null;
    }

    /**
     * @return ?array<ScimMappingItem>
     */
    public function getMapping(): ?array
    {
        return $this->mapping;
    }

    /**
     * @param ?array<ScimMappingItem> $value
     */
    public function setMapping(?array $value = null): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
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
