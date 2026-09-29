<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ExperimentStatusEnum;

class ListExperimentsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of experiments to return per page. Defaults to 25, maximum 50.
     */
    private ?int $take = 50;

    /**
     * @var ?value-of<ExperimentStatusEnum> $status Filter by status. Exact match.
     */
    private ?string $status;

    /**
     * @var ?string $authenticationFlow Filter by authentication flow. Exact match.
     */
    private ?string $authenticationFlow;

    /**
     * @var ?string $featureFlagId Filter by feature flag ID. Exact match.
     */
    private ?string $featureFlagId;

    /**
     * @param array{
     *   from?: ?string,
     *   take?: ?int,
     *   status?: ?value-of<ExperimentStatusEnum>,
     *   authenticationFlow?: ?string,
     *   featureFlagId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->authenticationFlow = $values['authenticationFlow'] ?? null;
        $this->featureFlagId = $values['featureFlagId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }

    /**
     * @return ?value-of<ExperimentStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<ExperimentStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAuthenticationFlow(): ?string
    {
        return $this->authenticationFlow;
    }

    /**
     * @param ?string $value
     */
    public function setAuthenticationFlow(?string $value = null): self
    {
        $this->authenticationFlow = $value;
        $this->_setField('authenticationFlow');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFeatureFlagId(): ?string
    {
        return $this->featureFlagId;
    }

    /**
     * @param ?string $value
     */
    public function setFeatureFlagId(?string $value = null): self
    {
        $this->featureFlagId = $value;
        $this->_setField('featureFlagId');
        return $this;
    }
}
