<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Represents an event that occurs when an organization is updated.
 */
class EventStreamCloudEventOrgUpdatedCloudEvent extends JsonSerializableType
{
    /**
     * @var string $specversion The version of the CloudEvents specification which the event uses.
     */
    #[JsonProperty('specversion')]
    private string $specversion;

    /**
     * @var value-of<EventStreamCloudEventOrgUpdatedCloudEventTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $source The source of the event. This will take the form 'urn:auth0:<tenant>.<domain>'.
     */
    #[JsonProperty('source')]
    private string $source;

    /**
     * @var string $id A unique identifier for the event.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var DateTime $time An ISO-8601 timestamp indicating when the event physically occurred.
     */
    #[JsonProperty('time'), Date(Date::TYPE_DATETIME)]
    private DateTime $time;

    /**
     * @var EventStreamCloudEventOrgUpdatedData $data
     */
    #[JsonProperty('data')]
    private EventStreamCloudEventOrgUpdatedData $data;

    /**
     * @var string $a0Tenant The auth0 tenant ID to which the event is associated.
     */
    #[JsonProperty('a0tenant')]
    private string $a0Tenant;

    /**
     * @var string $a0Stream The auth0 event stream ID of the stream the event was delivered on.
     */
    #[JsonProperty('a0stream')]
    private string $a0Stream;

    /**
     * @var ?value-of<EventStreamCloudEventA0PurposeEnum> $a0Purpose
     */
    #[JsonProperty('a0purpose')]
    private ?string $a0Purpose;

    /**
     * @param array{
     *   specversion: string,
     *   type: value-of<EventStreamCloudEventOrgUpdatedCloudEventTypeEnum>,
     *   source: string,
     *   id: string,
     *   time: DateTime,
     *   data: EventStreamCloudEventOrgUpdatedData,
     *   a0Tenant: string,
     *   a0Stream: string,
     *   a0Purpose?: ?value-of<EventStreamCloudEventA0PurposeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->specversion = $values['specversion'];
        $this->type = $values['type'];
        $this->source = $values['source'];
        $this->id = $values['id'];
        $this->time = $values['time'];
        $this->data = $values['data'];
        $this->a0Tenant = $values['a0Tenant'];
        $this->a0Stream = $values['a0Stream'];
        $this->a0Purpose = $values['a0Purpose'] ?? null;
    }

    /**
     * @return string
     */
    public function getSpecversion(): string
    {
        return $this->specversion;
    }

    /**
     * @param string $value
     */
    public function setSpecversion(string $value): self
    {
        $this->specversion = $value;
        $this->_setField('specversion');
        return $this;
    }

    /**
     * @return value-of<EventStreamCloudEventOrgUpdatedCloudEventTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<EventStreamCloudEventOrgUpdatedCloudEventTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $value
     */
    public function setSource(string $value): self
    {
        $this->source = $value;
        $this->_setField('source');
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTime(): DateTime
    {
        return $this->time;
    }

    /**
     * @param DateTime $value
     */
    public function setTime(DateTime $value): self
    {
        $this->time = $value;
        $this->_setField('time');
        return $this;
    }

    /**
     * @return EventStreamCloudEventOrgUpdatedData
     */
    public function getData(): EventStreamCloudEventOrgUpdatedData
    {
        return $this->data;
    }

    /**
     * @param EventStreamCloudEventOrgUpdatedData $value
     */
    public function setData(EventStreamCloudEventOrgUpdatedData $value): self
    {
        $this->data = $value;
        $this->_setField('data');
        return $this;
    }

    /**
     * @return string
     */
    public function getA0Tenant(): string
    {
        return $this->a0Tenant;
    }

    /**
     * @param string $value
     */
    public function setA0Tenant(string $value): self
    {
        $this->a0Tenant = $value;
        $this->_setField('a0Tenant');
        return $this;
    }

    /**
     * @return string
     */
    public function getA0Stream(): string
    {
        return $this->a0Stream;
    }

    /**
     * @param string $value
     */
    public function setA0Stream(string $value): self
    {
        $this->a0Stream = $value;
        $this->_setField('a0Stream');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventA0PurposeEnum>
     */
    public function getA0Purpose(): ?string
    {
        return $this->a0Purpose;
    }

    /**
     * @param ?value-of<EventStreamCloudEventA0PurposeEnum> $value
     */
    public function setA0Purpose(?string $value = null): self
    {
        $this->a0Purpose = $value;
        $this->_setField('a0Purpose');
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
