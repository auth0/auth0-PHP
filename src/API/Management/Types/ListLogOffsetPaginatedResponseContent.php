<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListLogOffsetPaginatedResponseContent extends JsonSerializableType
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
     * @var ?float $length
     */
    #[JsonProperty('length')]
    private ?float $length;

    /**
     * @var ?float $total
     */
    #[JsonProperty('total')]
    private ?float $total;

    /**
     * @var ?array<Log> $logs
     */
    #[JsonProperty('logs'), ArrayType([Log::class])]
    private ?array $logs;

    /**
     * @param array{
     *   start?: ?float,
     *   limit?: ?float,
     *   length?: ?float,
     *   total?: ?float,
     *   logs?: ?array<Log>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->start = $values['start'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->length = $values['length'] ?? null;
        $this->total = $values['total'] ?? null;
        $this->logs = $values['logs'] ?? null;
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
    public function getLength(): ?float
    {
        return $this->length;
    }

    /**
     * @param ?float $value
     */
    public function setLength(?float $value = null): self
    {
        $this->length = $value;
        $this->_setField('length');
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
     * @return ?array<Log>
     */
    public function getLogs(): ?array
    {
        return $this->logs;
    }

    /**
     * @param ?array<Log> $value
     */
    public function setLogs(?array $value = null): self
    {
        $this->logs = $value;
        $this->_setField('logs');
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
