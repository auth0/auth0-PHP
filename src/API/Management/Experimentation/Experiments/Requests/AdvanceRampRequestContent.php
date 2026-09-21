<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AdvanceRampRequestContent extends JsonSerializableType
{
    /**
     * @var int $targetLevel The target percentage level from the experiment schedule. Must be the immediate next level.
     */
    #[JsonProperty('target_level')]
    private int $targetLevel;

    /**
     * @param array{
     *   targetLevel: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->targetLevel = $values['targetLevel'];
    }

    /**
     * @return int
     */
    public function getTargetLevel(): int
    {
        return $this->targetLevel;
    }

    /**
     * @param int $value
     */
    public function setTargetLevel(int $value): self
    {
        $this->targetLevel = $value;
        $this->_setField('targetLevel');
        return $this;
    }
}
