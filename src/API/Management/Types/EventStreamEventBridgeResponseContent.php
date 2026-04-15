<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class EventStreamEventBridgeResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id Unique identifier for the event stream.
     */
    #[JsonProperty('id')]
    private ?string $id;

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
     * @var ?EventStreamEventBridgeDestination $destination
     */
    #[JsonProperty('destination')]
    private ?EventStreamEventBridgeDestination $destination;

    /**
     * @var ?value-of<EventStreamStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?DateTime $createdAt Timestamp when the event stream was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt Timestamp when the event stream was last updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   subscriptions?: ?array<EventStreamSubscription>,
     *   destination?: ?EventStreamEventBridgeDestination,
     *   status?: ?value-of<EventStreamStatusEnum>,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->subscriptions = $values['subscriptions'] ?? null;
        $this->destination = $values['destination'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
     * @return ?EventStreamEventBridgeDestination
     */
    public function getDestination(): ?EventStreamEventBridgeDestination
    {
        return $this->destination;
    }

    /**
     * @param ?EventStreamEventBridgeDestination $value
     */
    public function setDestination(?EventStreamEventBridgeDestination $value = null): self
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
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
