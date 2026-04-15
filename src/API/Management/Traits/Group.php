<?php

namespace Auth0\SDK\API\Management\Traits;

use DateTime;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Represents the metadata of a group. Member lists are retrieved via a separate endpoint.
 *
 * @property ?string $id
 * @property ?string $name
 * @property ?string $externalId
 * @property ?string $connectionId
 * @property ?string $tenantName
 * @property ?DateTime $createdAt
 * @property ?DateTime $updatedAt
 */
trait Group
{
    /**
     * @var ?string $id Unique identifier for the group (service-generated).
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name Name of the group. Must be unique within its connection. Must contain between 1 and 128 printable ASCII characters.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $externalId External identifier for the group, often used for SCIM synchronization. Max length of 256 characters.
     */
    #[JsonProperty('external_id')]
    private ?string $externalId;

    /**
     * @var ?string $connectionId Identifier for the connection this group belongs to (if a connection group).
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?string $tenantName Identifier for the tenant this group belongs to.
     */
    #[JsonProperty('tenant_name')]
    private ?string $tenantName;

    /**
     * @var ?DateTime $createdAt Timestamp of when the group was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt Timestamp of when the group was last updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalId(?string $value = null): self
    {
        $this->externalId = $value;
        $this->_setField('externalId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenantName(): ?string
    {
        return $this->tenantName;
    }

    /**
     * @param ?string $value
     */
    public function setTenantName(?string $value = null): self
    {
        $this->tenantName = $value;
        $this->_setField('tenantName');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }
}
