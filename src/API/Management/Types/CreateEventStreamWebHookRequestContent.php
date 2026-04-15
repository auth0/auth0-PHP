<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateEventStreamWebHookRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name Name of the event stream.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?array<EventStreamSubscription> $subscriptions List of event types subscribed to in this stream.
     */
    #[JsonProperty('subscriptions'), ArrayType([EventStreamSubscription::class])]
    private ?array $subscriptions;

    /**
     * @var EventStreamWebhookDestination $destination
     */
    #[JsonProperty('destination')]
    private EventStreamWebhookDestination $destination;

    /**
     * @var ?value-of<EventStreamStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @param array{
     *   destination: EventStreamWebhookDestination,
     *   name?: ?string,
     *   subscriptions?: ?array<EventStreamSubscription>,
     *   status?: ?value-of<EventStreamStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'] ?? null;
        $this->subscriptions = $values['subscriptions'] ?? null;
        $this->destination = $values['destination'];
        $this->status = $values['status'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?array<EventStreamSubscription>
     */
    public function getSubscriptions(): ?array
    {
        return $this->subscriptions;
    }

    /**
     * @param ?array<EventStreamSubscription> $value
     */
    public function setSubscriptions(?array $value = null): self
    {
        $this->subscriptions = $value;
        $this->_setField('subscriptions');
        return $this;
    }

    /**
     * @return EventStreamWebhookDestination
     */
    public function getDestination(): EventStreamWebhookDestination
    {
        return $this->destination;
    }

    /**
     * @param EventStreamWebhookDestination $value
     */
    public function setDestination(EventStreamWebhookDestination $value): self
    {
        $this->destination = $value;
        $this->_setField('destination');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<EventStreamStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
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
