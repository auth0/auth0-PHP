<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListAculsOffsetPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ListAculsResponseContentItem> $configs
     */
    #[JsonProperty('configs'), ArrayType([ListAculsResponseContentItem::class])]
    private ?array $configs;

    /**
     * @var ?float $start the index of the first configuration in the response (before filtering)
     */
    #[JsonProperty('start')]
    private ?float $start;

    /**
     * @var ?float $limit the maximum number of configurations shown per page (before filtering)
     */
    #[JsonProperty('limit')]
    private ?float $limit;

    /**
     * @var ?float $total the total number of configurations on this tenant
     */
    #[JsonProperty('total')]
    private ?float $total;

    /**
     * @param array{
     *   configs?: ?array<ListAculsResponseContentItem>,
     *   start?: ?float,
     *   limit?: ?float,
     *   total?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->configs = $values['configs'] ?? null;
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->total = $values['total'] ?? null;
    }

    /**
     * @return ?array<ListAculsResponseContentItem>
     */
    public function getConfigs(): ?array
    {
        return $this->configs;
    }

    /**
     * @param ?array<ListAculsResponseContentItem> $value
     */
    public function setConfigs(?array $value = null): self
    {
        $this->configs = $value;
        $this->_setField('configs');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
