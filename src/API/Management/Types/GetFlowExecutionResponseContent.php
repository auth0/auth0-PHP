<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class GetFlowExecutionResponseContent extends JsonSerializableType
{
    /**
     * @var string $id Flow execution identifier
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $traceId Trace id
     */
    #[JsonProperty('trace_id')]
    private string $traceId;

    /**
     * @var ?string $journeyId Journey id
     */
    #[JsonProperty('journey_id')]
    private ?string $journeyId;

    /**
     * @var string $status Execution status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var ?array<string, mixed> $debug
     */
    #[JsonProperty('debug'), ArrayType(['string' => 'mixed'])]
    private ?array $debug;

    /**
     * @var DateTime $createdAt The ISO 8601 formatted date when this flow execution was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt The ISO 8601 formatted date when this flow execution was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?DateTime $startedAt The ISO 8601 formatted date when this flow execution started.
     */
    #[JsonProperty('started_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $startedAt;

    /**
     * @var ?DateTime $endedAt The ISO 8601 formatted date when this flow execution ended.
     */
    #[JsonProperty('ended_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $endedAt;

    /**
     * @param array{
     *   id: string,
     *   traceId: string,
     *   status: string,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   journeyId?: ?string,
     *   debug?: ?array<string, mixed>,
     *   startedAt?: ?DateTime,
     *   endedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->traceId = $values['traceId'];
        $this->journeyId = $values['journeyId'] ?? null;
        $this->status = $values['status'];
        $this->debug = $values['debug'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->startedAt = $values['startedAt'] ?? null;
        $this->endedAt = $values['endedAt'] ?? null;
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
     * @return string
     */
    public function getTraceId(): string
    {
        return $this->traceId;
    }

    /**
     * @param string $value
     */
    public function setTraceId(string $value): self
    {
        $this->traceId = $value;
        $this->_setField('traceId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getJourneyId(): ?string
    {
        return $this->journeyId;
    }

    /**
     * @param ?string $value
     */
    public function setJourneyId(?string $value = null): self
    {
        $this->journeyId = $value;
        $this->_setField('journeyId');
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getDebug(): ?array
    {
        return $this->debug;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setDebug(?array $value = null): self
    {
        $this->debug = $value;
        $this->_setField('debug');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getStartedAt(): ?DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setStartedAt(?DateTime $value = null): self
    {
        $this->startedAt = $value;
        $this->_setField('startedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getEndedAt(): ?DateTime
    {
        return $this->endedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setEndedAt(?DateTime $value = null): self
    {
        $this->endedAt = $value;
        $this->_setField('endedAt');
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
