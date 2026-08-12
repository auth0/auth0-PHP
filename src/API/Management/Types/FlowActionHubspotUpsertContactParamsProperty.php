<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionHubspotUpsertContactParamsProperty extends JsonSerializableType
{
    /**
     * @var string $property
     */
    #[JsonProperty('property')]
    private string $property;

    /**
     * @param array{
     *   property: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->property = $values['property'];
    }

    /**
     * @return string
     */
    public function getProperty(): string
    {
        return $this->property;
    }

    /**
     * @param string $value
     */
    public function setProperty(string $value): self
    {
        $this->property = $value;
        $this->_setField('property');
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
