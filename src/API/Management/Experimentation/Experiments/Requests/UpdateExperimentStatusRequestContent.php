<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ExperimentTransitionStatusEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateExperimentStatusRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<ExperimentTransitionStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @param array{
     *   status: value-of<ExperimentTransitionStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return value-of<ExperimentTransitionStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<ExperimentTransitionStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }
}
