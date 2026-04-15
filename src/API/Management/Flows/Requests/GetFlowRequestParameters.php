<?php

namespace Auth0\SDK\API\Management\Flows\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\GetFlowRequestParametersHydrateEnum;

class GetFlowRequestParameters extends JsonSerializableType
{
    /**
     * @var ?array<?value-of<GetFlowRequestParametersHydrateEnum>> $hydrate hydration param
     */
    private ?array $hydrate;

    /**
     * @param array{
     *   hydrate?: ?array<?value-of<GetFlowRequestParametersHydrateEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hydrate = $values['hydrate'] ?? null;
    }

    /**
     * @return ?array<?value-of<GetFlowRequestParametersHydrateEnum>>
     */
    public function getHydrate(): ?array
    {
        return $this->hydrate;
    }

    /**
     * @param ?array<?value-of<GetFlowRequestParametersHydrateEnum>> $value
     */
    public function setHydrate(?array $value = null): self
    {
        $this->hydrate = $value;
        $this->_setField('hydrate');
        return $this;
    }
}
