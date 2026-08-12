<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserAuthenticationMethodsOffsetPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?float $start Index of the starting record. Derived from the page and per_page parameters.
     */
    #[JsonProperty('start')]
    private ?float $start;

    /**
     * @var ?float $limit Maximum amount of records to return.
     */
    #[JsonProperty('limit')]
    private ?float $limit;

    /**
     * @var ?float $total Total number of pageable records.
     */
    #[JsonProperty('total')]
    private ?float $total;

    /**
     * @var ?array<UserAuthenticationMethod> $authenticators The paginated authentication methods. Returned in this structure when include_totals is true.
     */
    #[JsonProperty('authenticators'), ArrayType([UserAuthenticationMethod::class])]
    private ?array $authenticators;

    /**
     * @param array{
     *   start?: ?float,
     *   limit?: ?float,
     *   total?: ?float,
     *   authenticators?: ?array<UserAuthenticationMethod>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->authenticators = $values['authenticators'] ?? null;
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
     * @return ?array<UserAuthenticationMethod>
     */
    public function getAuthenticators(): ?array
    {
        return $this->authenticators;
    }

    /**
     * @param ?array<UserAuthenticationMethod> $value
     */
    public function setAuthenticators(?array $value = null): self
    {
        $this->authenticators = $value;
        $this->_setField('authenticators');
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
