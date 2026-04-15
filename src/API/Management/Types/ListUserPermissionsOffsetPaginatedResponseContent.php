<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserPermissionsOffsetPaginatedResponseContent extends JsonSerializableType
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
     * @var ?array<UserPermissionSchema> $permissions
     */
    #[JsonProperty('permissions'), ArrayType([UserPermissionSchema::class])]
    private ?array $permissions;

    /**
     * @param array{
     *   start?: ?float,
     *   limit?: ?float,
     *   total?: ?float,
     *   permissions?: ?array<UserPermissionSchema>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->permissions = $values['permissions'] ?? null;
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
     * @return ?array<UserPermissionSchema>
     */
    public function getPermissions(): ?array
    {
        return $this->permissions;
    }

    /**
     * @param ?array<UserPermissionSchema> $value
     */
    public function setPermissions(?array $value = null): self
    {
        $this->permissions = $value;
        $this->_setField('permissions');
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
