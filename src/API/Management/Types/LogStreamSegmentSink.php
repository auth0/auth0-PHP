<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamSegmentSink extends JsonSerializableType
{
    /**
     * @var ?string $segmentWriteKey Segment write key
     */
    #[JsonProperty('segmentWriteKey')]
    private ?string $segmentWriteKey;

    /**
     * @param array{
     *   segmentWriteKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->segmentWriteKey = $values['segmentWriteKey'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSegmentWriteKey(): ?string
    {
        return $this->segmentWriteKey;
    }

    /**
     * @param ?string $value
     */
    public function setSegmentWriteKey(?string $value = null): self
    {
        $this->segmentWriteKey = $value;
        $this->_setField('segmentWriteKey');
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
