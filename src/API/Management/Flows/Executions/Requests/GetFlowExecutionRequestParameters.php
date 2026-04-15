<?php

namespace Auth0\SDK\API\Management\Flows\Executions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\GetFlowExecutionRequestParametersHydrateEnum;

class GetFlowExecutionRequestParameters extends JsonSerializableType
{
    /**
     * @var ?array<?value-of<GetFlowExecutionRequestParametersHydrateEnum>> $hydrate Hydration param
     */
    private ?array $hydrate;

    /**
     * @param array{
     *   hydrate?: ?array<?value-of<GetFlowExecutionRequestParametersHydrateEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hydrate = $values['hydrate'] ?? null;
    }

    /**
     * @return ?array<?value-of<GetFlowExecutionRequestParametersHydrateEnum>>
     */
    public function getHydrate(): ?array
    {
        return $this->hydrate;
    }

    /**
     * @param ?array<?value-of<GetFlowExecutionRequestParametersHydrateEnum>> $value
     */
    public function setHydrate(?array $value = null): self
    {
        $this->hydrate = $value;
        $this->_setField('hydrate');
        return $this;
    }
}
