<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListOrganizationMemberRolesOffsetPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?float $start
     */
    #[JsonProperty('start')]
    private ?float $start;

    /**
     * @var ?float $limit
     */
    #[JsonProperty('limit')]
    private ?float $limit;

    /**
     * @var ?float $total
     */
    #[JsonProperty('total')]
    private ?float $total;

    /**
     * @var ?array<Role> $roles
     */
    #[JsonProperty('roles'), ArrayType([Role::class])]
    private ?array $roles;

    /**
     * @param array{
     *   start?: ?float,
     *   limit?: ?float,
     *   total?: ?float,
     *   roles?: ?array<Role>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->roles = $values['roles'] ?? null;
    }

    /**
     * @return ?float
     */
    public function getStart(): ?float
    {
        return $this->start;
    }

    /**
     * @param ?float $value
     */
    public function setStart(?float $value = null): self
    {
        $this->start = $value;
        $this->_setField('start');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getLimit(): ?float
    {
        return $this->limit;
    }

    /**
     * @param ?float $value
     */
    public function setLimit(?float $value = null): self
    {
        $this->limit = $value;
        $this->_setField('limit');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param ?float $value
     */
    public function setTotal(?float $value = null): self
    {
        $this->total = $value;
        $this->_setField('total');
        return $this;
    }

    /**
     * @return ?array<Role>
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param ?array<Role> $value
     */
    public function setRoles(?array $value = null): self
    {
        $this->roles = $value;
        $this->_setField('roles');
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
