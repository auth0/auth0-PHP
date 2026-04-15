<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class GetDirectoryProvisioningDefaultMappingResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<DirectoryProvisioningMappingItem> $mapping The mapping between Auth0 and IDP user attributes
     */
    #[JsonProperty('mapping'), ArrayType([DirectoryProvisioningMappingItem::class])]
    private ?array $mapping;

    /**
     * @param array{
     *   mapping?: ?array<DirectoryProvisioningMappingItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mapping = $values['mapping'] ?? null;
    }

    /**
     * @return ?array<DirectoryProvisioningMappingItem>
     */
    public function getMapping(): ?array
    {
        return $this->mapping;
    }

    /**
     * @param ?array<DirectoryProvisioningMappingItem> $value
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
