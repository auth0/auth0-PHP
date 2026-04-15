<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class EventStreamDeliveryAttempt extends JsonSerializableType
{
    /**
     * @var value-of<EventStreamDeliveryStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var DateTime $timestamp Timestamp of delivery attempt
     */
    #[JsonProperty('timestamp'), Date(Date::TYPE_DATETIME)]
    private DateTime $timestamp;

    /**
     * @var ?string $errorMessage Delivery error message, if applicable
     */
    #[JsonProperty('error_message')]
    private ?string $errorMessage;

    /**
     * @param array{
     *   status: value-of<EventStreamDeliveryStatusEnum>,
     *   timestamp: DateTime,
     *   errorMessage?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->timestamp = $values['timestamp'];
        $this->errorMessage = $values['errorMessage'] ?? null;
    }

    /**
     * @return value-of<EventStreamDeliveryStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<EventStreamDeliveryStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTimestamp(): DateTime
    {
        return $this->timestamp;
    }

    /**
     * @param DateTime $value
     */
    public function setTimestamp(DateTime $value): self
    {
        $this->timestamp = $value;
        $this->_setField('timestamp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param ?string $value
     */
    public function setErrorMessage(?string $value = null): self
    {
        $this->errorMessage = $value;
        $this->_setField('errorMessage');
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
