<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateDirectoryProvisioningRequestContent extends JsonSerializableType
{
    /**
     * @var ?array<DirectoryProvisioningMappingItem> $mapping The mapping between Auth0 and IDP user attributes
     */
    #[JsonProperty('mapping'), ArrayType([DirectoryProvisioningMappingItem::class])]
    private ?array $mapping;

    /**
     * @var ?bool $synchronizeAutomatically Whether periodic automatic synchronization is enabled
     */
    #[JsonProperty('synchronize_automatically')]
    private ?bool $synchronizeAutomatically;

    /**
     * @var ?value-of<SynchronizeGroupsEnum> $synchronizeGroups
     */
    #[JsonProperty('synchronize_groups')]
    private ?string $synchronizeGroups;

    /**
     * @param array{
     *   mapping?: ?array<DirectoryProvisioningMappingItem>,
     *   synchronizeAutomatically?: ?bool,
     *   synchronizeGroups?: ?value-of<SynchronizeGroupsEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mapping = $values['mapping'] ?? null;
        $this->synchronizeAutomatically = $values['synchronizeAutomatically'] ?? null;
        $this->synchronizeGroups = $values['synchronizeGroups'] ?? null;
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
     * @return ?bool
     */
    public function getSynchronizeAutomatically(): ?bool
    {
        return $this->synchronizeAutomatically;
    }

    /**
     * @param ?bool $value
     */
    public function setSynchronizeAutomatically(?bool $value = null): self
    {
        $this->synchronizeAutomatically = $value;
        $this->_setField('synchronizeAutomatically');
        return $this;
    }

    /**
     * @return ?value-of<SynchronizeGroupsEnum>
     */
    public function getSynchronizeGroups(): ?string
    {
        return $this->synchronizeGroups;
    }

    /**
     * @param ?value-of<SynchronizeGroupsEnum> $value
     */
    public function setSynchronizeGroups(?string $value = null): self
    {
        $this->synchronizeGroups = $value;
        $this->_setField('synchronizeGroups');
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
