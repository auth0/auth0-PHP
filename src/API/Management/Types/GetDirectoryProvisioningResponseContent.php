<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class GetDirectoryProvisioningResponseContent extends JsonSerializableType
{
    /**
     * @var string $connectionId The connection's identifier
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $connectionName The connection's name
     */
    #[JsonProperty('connection_name')]
    private string $connectionName;

    /**
     * @var string $strategy The connection's strategy
     */
    #[JsonProperty('strategy')]
    private string $strategy;

    /**
     * @var array<DirectoryProvisioningMappingItem> $mapping The mapping between Auth0 and IDP user attributes
     */
    #[JsonProperty('mapping'), ArrayType([DirectoryProvisioningMappingItem::class])]
    private array $mapping;

    /**
     * @var bool $synchronizeAutomatically Whether periodic automatic synchronization is enabled
     */
    #[JsonProperty('synchronize_automatically')]
    private bool $synchronizeAutomatically;

    /**
     * @var ?value-of<SynchronizeGroupsEnum> $synchronizeGroups
     */
    #[JsonProperty('synchronize_groups')]
    private ?string $synchronizeGroups;

    /**
     * @var DateTime $createdAt The timestamp at which the directory provisioning configuration was created
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt The timestamp at which the directory provisioning configuration was last updated
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?DateTime $lastSynchronizationAt The timestamp at which the connection was last synchronized
     */
    #[JsonProperty('last_synchronization_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $lastSynchronizationAt;

    /**
     * @var ?string $lastSynchronizationStatus The status of the last synchronization
     */
    #[JsonProperty('last_synchronization_status')]
    private ?string $lastSynchronizationStatus;

    /**
     * @var ?string $lastSynchronizationError The error message of the last synchronization, if any
     */
    #[JsonProperty('last_synchronization_error')]
    private ?string $lastSynchronizationError;

    /**
     * @param array{
     *   connectionId: string,
     *   connectionName: string,
     *   strategy: string,
     *   mapping: array<DirectoryProvisioningMappingItem>,
     *   synchronizeAutomatically: bool,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   synchronizeGroups?: ?value-of<SynchronizeGroupsEnum>,
     *   lastSynchronizationAt?: ?DateTime,
     *   lastSynchronizationStatus?: ?string,
     *   lastSynchronizationError?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->connectionName = $values['connectionName'];
        $this->strategy = $values['strategy'];
        $this->mapping = $values['mapping'];
        $this->synchronizeAutomatically = $values['synchronizeAutomatically'];
        $this->synchronizeGroups = $values['synchronizeGroups'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->lastSynchronizationAt = $values['lastSynchronizationAt'] ?? null;
        $this->lastSynchronizationStatus = $values['lastSynchronizationStatus'] ?? null;
        $this->lastSynchronizationError = $values['lastSynchronizationError'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getConnectionName(): string
    {
        return $this->connectionName;
    }

    /**
     * @param string $value
     */
    public function setConnectionName(string $value): self
    {
        $this->connectionName = $value;
        $this->_setField('connectionName');
        return $this;
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @param string $value
     */
    public function setStrategy(string $value): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return array<DirectoryProvisioningMappingItem>
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * @param array<DirectoryProvisioningMappingItem> $value
     */
    public function setMapping(array $value): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
        return $this;
    }

    /**
     * @return bool
     */
    public function getSynchronizeAutomatically(): bool
    {
        return $this->synchronizeAutomatically;
    }

    /**
     * @param bool $value
     */
    public function setSynchronizeAutomatically(bool $value): self
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
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getLastSynchronizationAt(): ?DateTime
    {
        return $this->lastSynchronizationAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setLastSynchronizationAt(?DateTime $value = null): self
    {
        $this->lastSynchronizationAt = $value;
        $this->_setField('lastSynchronizationAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastSynchronizationStatus(): ?string
    {
        return $this->lastSynchronizationStatus;
    }

    /**
     * @param ?string $value
     */
    public function setLastSynchronizationStatus(?string $value = null): self
    {
        $this->lastSynchronizationStatus = $value;
        $this->_setField('lastSynchronizationStatus');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastSynchronizationError(): ?string
    {
        return $this->lastSynchronizationError;
    }

    /**
     * @param ?string $value
     */
    public function setLastSynchronizationError(?string $value = null): self
    {
        $this->lastSynchronizationError = $value;
        $this->_setField('lastSynchronizationError');
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
