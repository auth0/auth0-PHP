<?php

namespace Auth0\SDK\API\Management\EventStreams\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\EventStreamTestEventTypeEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateEventStreamTestEventRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamTestEventTypeEnum> $eventType
     */
    #[JsonProperty('event_type')]
    private string $eventType;

    /**
     * @var ?array<string, mixed> $data
     */
    #[JsonProperty('data'), ArrayType(['string' => 'mixed'])]
    private ?array $data;

    /**
     * @param array{
     *   eventType: value-of<EventStreamTestEventTypeEnum>,
     *   data?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->eventType = $values['eventType'];
        $this->data = $values['data'] ?? null;
    }

    /**
     * @return value-of<EventStreamTestEventTypeEnum>
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @param value-of<EventStreamTestEventTypeEnum> $value
     */
    public function setEventType(string $value): self
    {
        $this->eventType = $value;
        $this->_setField('eventType');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getData(): ?array
    {
        return $this->data;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setData(?array $value = null): self
    {
        $this->data = $value;
        $this->_setField('data');
        return $this;
    }
}
