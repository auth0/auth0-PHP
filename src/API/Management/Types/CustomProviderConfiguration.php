<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CustomProviderConfiguration extends JsonSerializableType
{
    /**
     * @var array<value-of<CustomProviderDeliveryMethodEnum>> $deliveryMethods
     */
    #[JsonProperty('delivery_methods'), ArrayType(['string'])]
    private array $deliveryMethods;

    /**
     * @param array{
     *   deliveryMethods: array<value-of<CustomProviderDeliveryMethodEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->deliveryMethods = $values['deliveryMethods'];
    }

    /**
     * @return array<value-of<CustomProviderDeliveryMethodEnum>>
     */
    public function getDeliveryMethods(): array
    {
        return $this->deliveryMethods;
    }

    /**
     * @param array<value-of<CustomProviderDeliveryMethodEnum>> $value
     */
    public function setDeliveryMethods(array $value): self
    {
        $this->deliveryMethods = $value;
        $this->_setField('deliveryMethods');
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
