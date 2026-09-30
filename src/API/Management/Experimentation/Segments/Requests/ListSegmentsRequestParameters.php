<?php

namespace Auth0\SDK\API\Management\Experimentation\Segments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\SegmentTypeFilterEnum;

class ListSegmentsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of segments to return per page. Defaults to 25, maximum 50.
     */
    private ?int $take = 50;

    /**
     * @var ?value-of<SegmentTypeFilterEnum> $type Filter by type. Exact match.
     */
    private ?string $type;

    /**
     * @param array{
     *   from?: ?string,
     *   take?: ?int,
     *   type?: ?value-of<SegmentTypeFilterEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->type = $values['type'] ?? null;
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
     * @return ?value-of<SegmentTypeFilterEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<SegmentTypeFilterEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }
}
