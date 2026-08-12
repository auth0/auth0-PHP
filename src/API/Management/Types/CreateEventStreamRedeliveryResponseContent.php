<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use DateTime;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateEventStreamRedeliveryResponseContent extends JsonSerializableType
{
    /**
     * @var ?DateTime $dateFrom An RFC-3339 date-time for redelivery start, inclusive. Does not allow sub-second precision.
     */
    #[JsonProperty('date_from'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $dateFrom;

    /**
     * @var ?DateTime $dateTo An RFC-3339 date-time for redelivery end, exclusive. Does not allow sub-second precision.
     */
    #[JsonProperty('date_to'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $dateTo;

    /**
     * @var ?array<value-of<EventStreamDeliveryStatusEnum>> $statuses Filter by status
     */
    #[JsonProperty('statuses'), ArrayType(['string'])]
    private ?array $statuses;

    /**
     * @var ?array<value-of<EventStreamEventTypeEnum>> $eventTypes Filter by event type
     */
    #[JsonProperty('event_types'), ArrayType(['string'])]
    private ?array $eventTypes;

    /**
     * @param array{
     *   dateFrom?: ?DateTime,
     *   dateTo?: ?DateTime,
     *   statuses?: ?array<value-of<EventStreamDeliveryStatusEnum>>,
     *   eventTypes?: ?array<value-of<EventStreamEventTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->dateFrom = $values['dateFrom'] ?? null;
        $this->dateTo = $values['dateTo'] ?? null;
        $this->statuses = $values['statuses'] ?? null;
        $this->eventTypes = $values['eventTypes'] ?? null;
    }

    /**
     * @return ?DateTime
     */
    public function getDateFrom(): ?DateTime
    {
        return $this->dateFrom;
    }

    /**
     * @param ?DateTime $value
     */
    public function setDateFrom(?DateTime $value = null): self
    {
        $this->dateFrom = $value;
        $this->_setField('dateFrom');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getDateTo(): ?DateTime
    {
        return $this->dateTo;
    }

    /**
     * @param ?DateTime $value
     */
    public function setDateTo(?DateTime $value = null): self
    {
        $this->dateTo = $value;
        $this->_setField('dateTo');
        return $this;
    }

    /**
     * @return ?array<value-of<EventStreamDeliveryStatusEnum>>
     */
    public function getStatuses(): ?array
    {
        return $this->statuses;
    }

    /**
     * @param ?array<value-of<EventStreamDeliveryStatusEnum>> $value
     */
    public function setStatuses(?array $value = null): self
    {
        $this->statuses = $value;
        $this->_setField('statuses');
        return $this;
    }

    /**
     * @return ?array<value-of<EventStreamEventTypeEnum>>
     */
    public function getEventTypes(): ?array
    {
        return $this->eventTypes;
    }

    /**
     * @param ?array<value-of<EventStreamEventTypeEnum>> $value
     */
    public function setEventTypes(?array $value = null): self
    {
        $this->eventTypes = $value;
        $this->_setField('eventTypes');
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
