<?php

namespace Auth0\SDK\API\Management\Forms\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\FormsRequestParametersHydrateEnum;

class GetFormRequestParameters extends JsonSerializableType
{
    /**
     * @var ?array<?value-of<FormsRequestParametersHydrateEnum>> $hydrate Query parameter to hydrate the response with additional data
     */
    private ?array $hydrate;

    /**
     * @param array{
     *   hydrate?: ?array<?value-of<FormsRequestParametersHydrateEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->hydrate = $values['hydrate'] ?? null;
    }

    /**
     * @return ?array<?value-of<FormsRequestParametersHydrateEnum>>
     */
    public function getHydrate(): ?array
    {
        return $this->hydrate;
    }

    /**
     * @param ?array<?value-of<FormsRequestParametersHydrateEnum>> $value
     */
    public function setHydrate(?array $value = null): self
    {
        $this->hydrate = $value;
        $this->_setField('hydrate');
        return $this;
    }
}
