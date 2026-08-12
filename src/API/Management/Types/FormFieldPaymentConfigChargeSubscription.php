<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldPaymentConfigChargeSubscription extends JsonSerializableType
{
    /**
     * @var value-of<FormFieldPaymentConfigChargeTypeSubscriptionConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var array<string, mixed> $subscription
     */
    #[JsonProperty('subscription'), ArrayType(['string' => 'mixed'])]
    private array $subscription;

    /**
     * @param array{
     *   type: value-of<FormFieldPaymentConfigChargeTypeSubscriptionConst>,
     *   subscription: array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->subscription = $values['subscription'];
    }

    /**
     * @return value-of<FormFieldPaymentConfigChargeTypeSubscriptionConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormFieldPaymentConfigChargeTypeSubscriptionConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSubscription(): array
    {
        return $this->subscription;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setSubscription(array $value): self
    {
        $this->subscription = $value;
        $this->_setField('subscription');
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
