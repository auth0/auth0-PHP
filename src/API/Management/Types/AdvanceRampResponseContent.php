<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class AdvanceRampResponseContent extends JsonSerializableType
{
    /**
     * @var string $experimentId
     */
    #[JsonProperty('experiment_id')]
    private string $experimentId;

    /**
     * @var int $fromLevel
     */
    #[JsonProperty('from_level')]
    private int $fromLevel;

    /**
     * @var int $toLevel
     */
    #[JsonProperty('to_level')]
    private int $toLevel;

    /**
     * @var int $currentLevel
     */
    #[JsonProperty('current_level')]
    private int $currentLevel;

    /**
     * @param array{
     *   experimentId: string,
     *   fromLevel: int,
     *   toLevel: int,
     *   currentLevel: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->experimentId = $values['experimentId'];
        $this->fromLevel = $values['fromLevel'];
        $this->toLevel = $values['toLevel'];
        $this->currentLevel = $values['currentLevel'];
    }

    /**
     * @return string
     */
    public function getExperimentId(): string
    {
        return $this->experimentId;
    }

    /**
     * @param string $value
     */
    public function setExperimentId(string $value): self
    {
        $this->experimentId = $value;
        $this->_setField('experimentId');
        return $this;
    }

    /**
     * @return int
     */
    public function getFromLevel(): int
    {
        return $this->fromLevel;
    }

    /**
     * @param int $value
     */
    public function setFromLevel(int $value): self
    {
        $this->fromLevel = $value;
        $this->_setField('fromLevel');
        return $this;
    }

    /**
     * @return int
     */
    public function getToLevel(): int
    {
        return $this->toLevel;
    }

    /**
     * @param int $value
     */
    public function setToLevel(int $value): self
    {
        $this->toLevel = $value;
        $this->_setField('toLevel');
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentLevel(): int
    {
        return $this->currentLevel;
    }

    /**
     * @param int $value
     */
    public function setCurrentLevel(int $value): self
    {
        $this->currentLevel = $value;
        $this->_setField('currentLevel');
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
