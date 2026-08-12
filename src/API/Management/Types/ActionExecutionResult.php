<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Captures the results of a single action being executed.
 */
class ActionExecutionResult extends JsonSerializableType
{
    /**
     * @var ?string $actionName The name of the action that was executed.
     */
    #[JsonProperty('action_name')]
    private ?string $actionName;

    /**
     * @var ?ActionError $error
     */
    #[JsonProperty('error')]
    private ?ActionError $error;

    /**
     * @var ?DateTime $startedAt The time when the action was started.
     */
    #[JsonProperty('started_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $startedAt;

    /**
     * @var ?DateTime $endedAt The time when the action finished executing.
     */
    #[JsonProperty('ended_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $endedAt;

    /**
     * @param array{
     *   actionName?: ?string,
     *   error?: ?ActionError,
     *   startedAt?: ?DateTime,
     *   endedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->actionName = $values['actionName'] ?? null;
        $this->error = $values['error'] ?? null;
        $this->startedAt = $values['startedAt'] ?? null;
        $this->endedAt = $values['endedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * @param ?string $value
     */
    public function setActionName(?string $value = null): self
    {
        $this->actionName = $value;
        $this->_setField('actionName');
        return $this;
    }

    /**
     * @return ?ActionError
     */
    public function getError(): ?ActionError
    {
        return $this->error;
    }

    /**
     * @param ?ActionError $value
     */
    public function setError(?ActionError $value = null): self
    {
        $this->error = $value;
        $this->_setField('error');
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
