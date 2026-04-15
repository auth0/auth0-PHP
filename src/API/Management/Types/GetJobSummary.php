<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Job execution summary.
 */
class GetJobSummary extends JsonSerializableType
{
    /**
     * @var ?int $failed Number of failed operations.
     */
    #[JsonProperty('failed')]
    private ?int $failed;

    /**
     * @var ?int $updated Number of updated records.
     */
    #[JsonProperty('updated')]
    private ?int $updated;

    /**
     * @var ?int $inserted Number of inserted records.
     */
    #[JsonProperty('inserted')]
    private ?int $inserted;

    /**
     * @var ?int $total Total number of operations.
     */
    #[JsonProperty('total')]
    private ?int $total;

    /**
     * @param array{
     *   failed?: ?int,
     *   updated?: ?int,
     *   inserted?: ?int,
     *   total?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->failed = $values['failed'] ?? null;
        $this->updated = $values['updated'] ?? null;
        $this->inserted = $values['inserted'] ?? null;
        $this->total = $values['total'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getFailed(): ?int
    {
        return $this->failed;
    }

    /**
     * @param ?int $value
     */
    public function setFailed(?int $value = null): self
    {
        $this->failed = $value;
        $this->_setField('failed');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getUpdated(): ?int
    {
        return $this->updated;
    }

    /**
     * @param ?int $value
     */
    public function setUpdated(?int $value = null): self
    {
        $this->updated = $value;
        $this->_setField('updated');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getInserted(): ?int
    {
        return $this->inserted;
    }

    /**
     * @param ?int $value
     */
    public function setInserted(?int $value = null): self
    {
        $this->inserted = $value;
        $this->_setField('inserted');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param ?int $value
     */
    public function setTotal(?int $value = null): self
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
