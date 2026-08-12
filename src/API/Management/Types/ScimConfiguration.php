<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class ScimConfiguration extends JsonSerializableType
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
     * @var string $tenantName The tenant's name
     */
    #[JsonProperty('tenant_name')]
    private string $tenantName;

    /**
     * @var string $userIdAttribute User ID attribute for generating unique user ids
     */
    #[JsonProperty('user_id_attribute')]
    private string $userIdAttribute;

    /**
     * @var array<ScimMappingItem> $mapping The mapping between auth0 and SCIM
     */
    #[JsonProperty('mapping'), ArrayType([ScimMappingItem::class])]
    private array $mapping;

    /**
     * @var DateTime $createdAt The ISO 8601 date and time the SCIM configuration was created at
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedOn The ISO 8601 date and time the SCIM configuration was last updated on
     */
    #[JsonProperty('updated_on'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedOn;

    /**
     * @param array{
     *   connectionId: string,
     *   connectionName: string,
     *   strategy: string,
     *   tenantName: string,
     *   userIdAttribute: string,
     *   mapping: array<ScimMappingItem>,
     *   createdAt: DateTime,
     *   updatedOn: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->connectionName = $values['connectionName'];
        $this->strategy = $values['strategy'];
        $this->tenantName = $values['tenantName'];
        $this->userIdAttribute = $values['userIdAttribute'];
        $this->mapping = $values['mapping'];
        $this->createdAt = $values['createdAt'];
        $this->updatedOn = $values['updatedOn'];
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
     * @return string
     */
    public function getTenantName(): string
    {
        return $this->tenantName;
    }

    /**
     * @param string $value
     */
    public function setTenantName(string $value): self
    {
        $this->tenantName = $value;
        $this->_setField('tenantName');
        return $this;
    }

    /**
     * @return string
     */
    public function getUserIdAttribute(): string
    {
        return $this->userIdAttribute;
    }

    /**
     * @param string $value
     */
    public function setUserIdAttribute(string $value): self
    {
        $this->userIdAttribute = $value;
        $this->_setField('userIdAttribute');
        return $this;
    }

    /**
     * @return array<ScimMappingItem>
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * @param array<ScimMappingItem> $value
     */
    public function setMapping(array $value): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
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
    public function getUpdatedOn(): DateTime
    {
        return $this->updatedOn;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedOn(DateTime $value): self
    {
        $this->updatedOn = $value;
        $this->_setField('updatedOn');
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
