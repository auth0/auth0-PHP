<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EventStreamWebhookDestination extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamWebhookDestinationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var EventStreamWebhookConfiguration $configuration
     */
    #[JsonProperty('configuration')]
    private EventStreamWebhookConfiguration $configuration;

    /**
     * @param array{
     *   type: value-of<EventStreamWebhookDestinationTypeEnum>,
     *   configuration: EventStreamWebhookConfiguration,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->configuration = $values['configuration'];
    }

    /**
     * @return value-of<EventStreamWebhookDestinationTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamWebhookDestinationTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return EventStreamWebhookConfiguration
     */
    public function getConfiguration(): EventStreamWebhookConfiguration
    {
        return $this->configuration;
    }

    /**
     * @param EventStreamWebhookConfiguration $value
     */
    public function setConfiguration(EventStreamWebhookConfiguration $value): self
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
