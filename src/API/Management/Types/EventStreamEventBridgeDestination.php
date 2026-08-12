<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EventStreamEventBridgeDestination extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamEventBridgeDestinationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var EventStreamEventBridgeConfiguration $configuration
     */
    #[JsonProperty('configuration')]
    private EventStreamEventBridgeConfiguration $configuration;

    /**
     * @param array{
     *   type: value-of<EventStreamEventBridgeDestinationTypeEnum>,
     *   configuration: EventStreamEventBridgeConfiguration,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->configuration = $values['configuration'];
    }

    /**
     * @return value-of<EventStreamEventBridgeDestinationTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamEventBridgeDestinationTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return EventStreamEventBridgeConfiguration
     */
    public function getConfiguration(): EventStreamEventBridgeConfiguration
    {
        return $this->configuration;
    }

    /**
     * @param EventStreamEventBridgeConfiguration $value
     */
    public function setConfiguration(EventStreamEventBridgeConfiguration $value): self
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
