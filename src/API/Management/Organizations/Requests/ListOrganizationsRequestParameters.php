<?php

namespace Auth0\SDK\API\Management\Organizations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListOrganizationsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $sort Field to sort by. Use <code>field:order</code> where order is <code>1</code> for ascending and <code>-1</code> for descending. e.g. <code>created_at:1</code>. We currently support sorting by the following fields: <code>name</code>, <code>display_name</code> and <code>created_at</code>.
     */
    private ?string $sort;

    /**
     * @var ?string $includeClientAssociationFor Client ID. When set, each returned organization that has an association with this client gains a <code>client</code> object describing it; organizations without one omit the field.
     */
    private ?string $includeClientAssociationFor;

    /**
     * @param array{
     *   includeTotals?: ?bool,
     *   from?: ?string,
     *   take?: ?int,
     *   sort?: ?string,
     *   includeClientAssociationFor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->sort = $values['sort'] ?? null;
        $this->includeClientAssociationFor = $values['includeClientAssociationFor'] ?? null;
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
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSort(): ?string
    {
        return $this->sort;
    }

    /**
     * @param ?string $value
     */
    public function setSort(?string $value = null): self
    {
        $this->sort = $value;
        $this->_setField('sort');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIncludeClientAssociationFor(): ?string
    {
        return $this->includeClientAssociationFor;
    }

    /**
     * @param ?string $value
     */
    public function setIncludeClientAssociationFor(?string $value = null): self
    {
        $this->includeClientAssociationFor = $value;
        $this->_setField('includeClientAssociationFor');
        return $this;
    }
}
