<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Event types
 */
class EventStreamSubscription extends JsonSerializableType
{
    /**
     * @var ?string $eventType
     */
    #[JsonProperty('event_type')]
    private ?string $eventType;

    /**
     * @param array{
     *   eventType?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->eventType = $values['eventType'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getEventType(): ?string
    {
        return $this->eventType;
    }

    /**
     * @param ?string $value
     */
    public function setEventType(?string $value = null): self
    {
        $this->eventType = $value;
        $this->_setField('eventType');
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
