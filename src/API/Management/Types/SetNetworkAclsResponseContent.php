<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetNetworkAclsResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $description
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?bool $active
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?float $priority
     */
    #[JsonProperty('priority')]
    private ?float $priority;

    /**
     * @var ?NetworkAclRule $rule
     */
    #[JsonProperty('rule')]
    private ?NetworkAclRule $rule;

    /**
     * @var ?string $createdAt The timestamp when the Network ACL Configuration was created
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @var ?string $updatedAt The timestamp when the Network ACL Configuration was last updated
     */
    #[JsonProperty('updated_at')]
    private ?string $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   description?: ?string,
     *   active?: ?bool,
     *   priority?: ?float,
     *   rule?: ?NetworkAclRule,
     *   createdAt?: ?string,
     *   updatedAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->active = $values['active'] ?? null;
        $this->priority = $values['priority'] ?? null;
        $this->rule = $values['rule'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
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
     * @return ?float
     */
    public function getPriority(): ?float
    {
        return $this->priority;
    }

    /**
     * @param ?float $value
     */
    public function setPriority(?float $value = null): self
    {
        $this->priority = $value;
        $this->_setField('priority');
        return $this;
    }

    /**
     * @return ?NetworkAclRule
     */
    public function getRule(): ?NetworkAclRule
    {
        return $this->rule;
    }

    /**
     * @param ?NetworkAclRule $value
     */
    public function setRule(?NetworkAclRule $value = null): self
    {
        $this->rule = $value;
        $this->_setField('rule');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param ?string $value
     */
    public function setUpdatedAt(?string $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
