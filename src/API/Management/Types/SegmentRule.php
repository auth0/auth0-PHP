<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SegmentRule extends JsonSerializableType
{
    /**
     * @var ?SegmentMatchConditions $match
     */
    #[JsonProperty('match')]
    private ?SegmentMatchConditions $match;

    /**
     * @var ?SegmentNotMatchConditions $notMatch
     */
    #[JsonProperty('not_match')]
    private ?SegmentNotMatchConditions $notMatch;

    /**
     * @param array{
     *   match?: ?SegmentMatchConditions,
     *   notMatch?: ?SegmentNotMatchConditions,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->match = $values['match'] ?? null;
        $this->notMatch = $values['notMatch'] ?? null;
    }

    /**
     * @return ?SegmentMatchConditions
     */
    public function getMatch(): ?SegmentMatchConditions
    {
        return $this->match;
    }

    /**
     * @param ?SegmentMatchConditions $value
     */
    public function setMatch(?SegmentMatchConditions $value = null): self
    {
        $this->match = $value;
        $this->_setField('match');
        return $this;
    }

    /**
     * @return ?SegmentNotMatchConditions
     */
    public function getNotMatch(): ?SegmentNotMatchConditions
    {
        return $this->notMatch;
    }

    /**
     * @param ?SegmentNotMatchConditions $value
     */
    public function setNotMatch(?SegmentNotMatchConditions $value = null): self
    {
        $this->notMatch = $value;
        $this->_setField('notMatch');
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
