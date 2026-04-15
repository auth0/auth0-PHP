<?php

namespace Auth0\SDK\API\Management\EventStreams\Deliveries\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListEventStreamDeliveriesRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $statuses Comma-separated list of statuses by which to filter
     */
    private ?string $statuses;

    /**
     * @var ?string $eventTypes Comma-separated list of event types by which to filter
     */
    private ?string $eventTypes;

    /**
     * @var ?string $dateFrom An RFC-3339 date-time for redelivery start, inclusive. Does not allow sub-second precision.
     */
    private ?string $dateFrom;

    /**
     * @var ?string $dateTo An RFC-3339 date-time for redelivery end, exclusive. Does not allow sub-second precision.
     */
    private ?string $dateTo;

    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @param array{
     *   statuses?: ?string,
     *   eventTypes?: ?string,
     *   dateFrom?: ?string,
     *   dateTo?: ?string,
     *   from?: ?string,
     *   take?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->statuses = $values['statuses'] ?? null;
        $this->eventTypes = $values['eventTypes'] ?? null;
        $this->dateFrom = $values['dateFrom'] ?? null;
        $this->dateTo = $values['dateTo'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getStatuses(): ?string
    {
        return $this->statuses;
    }

    /**
     * @param ?string $value
     */
    public function setStatuses(?string $value = null): self
    {
        $this->statuses = $value;
        $this->_setField('statuses');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEventTypes(): ?string
    {
        return $this->eventTypes;
    }

    /**
     * @param ?string $value
     */
    public function setEventTypes(?string $value = null): self
    {
        $this->eventTypes = $value;
        $this->_setField('eventTypes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param ?string $value
     */
    public function setDateFrom(?string $value = null): self
    {
        $this->dateFrom = $value;
        $this->_setField('dateFrom');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param ?string $value
     */
    public function setDateTo(?string $value = null): self
    {
        $this->dateTo = $value;
        $this->_setField('dateTo');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }
}
