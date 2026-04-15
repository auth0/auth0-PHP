<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * The result of a specific execution of a trigger.
 */
class GetActionExecutionResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id ID identifies this specific execution simulation. These IDs would resemble real executions in production.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?value-of<ActionTriggerTypeEnum> $triggerId
     */
    #[JsonProperty('trigger_id')]
    private ?string $triggerId;

    /**
     * @var ?value-of<ActionExecutionStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?array<ActionExecutionResult> $results
     */
    #[JsonProperty('results'), ArrayType([ActionExecutionResult::class])]
    private ?array $results;

    /**
     * @var ?DateTime $createdAt The time that the execution was started.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time that the exeution finished executing.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   triggerId?: ?value-of<ActionTriggerTypeEnum>,
     *   status?: ?value-of<ActionExecutionStatusEnum>,
     *   results?: ?array<ActionExecutionResult>,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->triggerId = $values['triggerId'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->results = $values['results'] ?? null;
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
     * @return ?value-of<ActionTriggerTypeEnum>
     */
    public function getTriggerId(): ?string
    {
        return $this->triggerId;
    }

    /**
     * @param ?value-of<ActionTriggerTypeEnum> $value
     */
    public function setTriggerId(?string $value = null): self
    {
        $this->triggerId = $value;
        $this->_setField('triggerId');
        return $this;
    }

    /**
     * @return ?value-of<ActionExecutionStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<ActionExecutionStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?array<ActionExecutionResult>
     */
    public function getResults(): ?array
    {
        return $this->results;
    }

    /**
     * @param ?array<ActionExecutionResult> $value
     */
    public function setResults(?array $value = null): self
    {
        $this->results = $value;
        $this->_setField('results');
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
