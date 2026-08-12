<?php

namespace Auth0\SDK\API\Management\Roles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\RoleTypeEnum;

class ListRolesRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $perPage Number of results per page. Defaults to 50.
     */
    private ?int $perPage = 50;

    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $nameFilter Optional filter on name (case-insensitive).
     */
    private ?string $nameFilter;

    /**
     * @var ?value-of<RoleTypeEnum> $type Optional filter on the type of the role
     */
    private ?string $type;

    /**
     * @var ?string $ownerId Filter organization-level roles by owner ID. Required when type is "organization".
     */
    private ?string $ownerId;

    /**
     * @param array{
     *   perPage?: ?int,
     *   page?: ?int,
     *   includeTotals?: ?bool,
     *   nameFilter?: ?string,
     *   type?: ?value-of<RoleTypeEnum>,
     *   ownerId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->perPage = $values['perPage'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->nameFilter = $values['nameFilter'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->ownerId = $values['ownerId'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param ?int $value
     */
    public function setPerPage(?int $value = null): self
    {
        $this->perPage = $value;
        $this->_setField('perPage');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param ?int $value
     */
    public function setPage(?int $value = null): self
    {
        $this->page = $value;
        $this->_setField('page');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->includeTotals;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeTotals(?bool $value = null): self
    {
        $this->includeTotals = $value;
        $this->_setField('includeTotals');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getNameFilter(): ?string
    {
        return $this->nameFilter;
    }

    /**
     * @param ?string $value
     */
    public function setNameFilter(?string $value = null): self
    {
        $this->nameFilter = $value;
        $this->_setField('nameFilter');
        return $this;
    }

    /**
     * @return ?value-of<RoleTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<RoleTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOwnerId(): ?string
    {
        return $this->ownerId;
    }

    /**
     * @param ?string $value
     */
    public function setOwnerId(?string $value = null): self
    {
        $this->ownerId = $value;
        $this->_setField('ownerId');
        return $this;
    }
}
