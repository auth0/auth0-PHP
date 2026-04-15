<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Event content. This will only be set if delivery failed.
 */
class EventStreamCloudEvent extends JsonSerializableType
{
    /**
     * @var ?string $id Unique identifier for the event
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $source Where the event originated
     */
    #[JsonProperty('source')]
    private ?string $source;

    /**
     * @var ?string $specversion Version of CloudEvents spec
     */
    #[JsonProperty('specversion')]
    private ?string $specversion;

    /**
     * @var ?string $type Type of the event (e.g., user.created)
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?DateTime $time Timestamp at which the event was generated
     */
    #[JsonProperty('time'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $time;

    /**
     * @var ?string $data Event contents encoded as a string.
     */
    #[JsonProperty('data')]
    private ?string $data;

    /**
     * @param array{
     *   id?: ?string,
     *   source?: ?string,
     *   specversion?: ?string,
     *   type?: ?string,
     *   time?: ?DateTime,
     *   data?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->specversion = $values['specversion'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->time = $values['time'] ?? null;
        $this->data = $values['data'] ?? null;
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
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * @param ?string $value
     */
    public function setSource(?string $value = null): self
    {
        $this->source = $value;
        $this->_setField('source');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSpecversion(): ?string
    {
        return $this->specversion;
    }

    /**
     * @param ?string $value
     */
    public function setSpecversion(?string $value = null): self
    {
        $this->specversion = $value;
        $this->_setField('specversion');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?string $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getTime(): ?DateTime
    {
        return $this->time;
    }

    /**
     * @param ?DateTime $value
     */
    public function setTime(?DateTime $value = null): self
    {
        $this->time = $value;
        $this->_setField('time');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param ?string $value
     */
    public function setData(?string $value = null): self
    {
        $this->data = $value;
        $this->_setField('data');
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
