<?php

namespace Auth0\SDK\API\Management\Forms\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\FormsRequestParametersHydrateEnum;

class ListFormsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page. Defaults to 50.
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?array<?value-of<FormsRequestParametersHydrateEnum>> $hydrate Query parameter to hydrate the response with additional data
     */
    private ?array $hydrate;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   hydrate?: ?array<?value-of<FormsRequestParametersHydrateEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->hydrate = $values['hydrate'] ?? null;
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
     * @return ?array<?value-of<FormsRequestParametersHydrateEnum>>
     */
    public function getHydrate(): ?array
    {
        return $this->hydrate;
    }

    /**
     * @param ?array<?value-of<FormsRequestParametersHydrateEnum>> $value
     */
    public function setHydrate(?array $value = null): self
    {
        $this->hydrate = $value;
        $this->_setField('hydrate');
        return $this;
    }
}
