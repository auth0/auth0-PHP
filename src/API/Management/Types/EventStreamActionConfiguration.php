<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration specific to an action destination.
 */
class EventStreamActionConfiguration extends JsonSerializableType
{
    /**
     * @var string $actionId Action ID for the action destination.
     */
    #[JsonProperty('action_id')]
    private string $actionId;

    /**
     * @param array{
     *   actionId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->actionId = $values['actionId'];
    }

    /**
     * @return string
     */
    public function getActionId(): string
    {
        return $this->actionId;
    }

    /**
     * @param string $value
     */
    public function setActionId(string $value): self
    {
        $this->actionId = $value;
        $this->_setField('actionId');
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
