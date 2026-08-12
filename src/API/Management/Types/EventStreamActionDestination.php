<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EventStreamActionDestination extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamActionDestinationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var EventStreamActionConfiguration $configuration
     */
    #[JsonProperty('configuration')]
    private EventStreamActionConfiguration $configuration;

    /**
     * @param array{
     *   type: value-of<EventStreamActionDestinationTypeEnum>,
     *   configuration: EventStreamActionConfiguration,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->configuration = $values['configuration'];
    }

    /**
     * @return value-of<EventStreamActionDestinationTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamActionDestinationTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return EventStreamActionConfiguration
     */
    public function getConfiguration(): EventStreamActionConfiguration
    {
        return $this->configuration;
    }

    /**
     * @param EventStreamActionConfiguration $value
     */
    public function setConfiguration(EventStreamActionConfiguration $value): self
    {
        $this->configuration = $value;
        $this->_setField('configuration');
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
