<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormFieldPaymentConfigChargeOneOffOneOff extends JsonSerializableType
{
    /**
     * @var (
     *    string
     *   |float
     * ) $amount
     */
    #[JsonProperty('amount'), Union('string', 'float')]
    private string|float $amount;

    /**
     * @var value-of<FormFieldPaymentConfigChargeOneOffCurrencyEnum> $currency
     */
    #[JsonProperty('currency')]
    private string $currency;

    /**
     * @param array{
     *   amount: (
     *    string
     *   |float
     * ),
     *   currency: value-of<FormFieldPaymentConfigChargeOneOffCurrencyEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->amount = $values['amount'];
        $this->currency = $values['currency'];
    }

    /**
     * @return (
     *    string
     *   |float
     * )
     */
    public function getAmount(): string|float
    {
        return $this->amount;
    }

    /**
     * @param (
     *    string
     *   |float
     * ) $value
     */
    public function setAmount(string|float $value): self
    {
        $this->amount = $value;
        $this->_setField('amount');
        return $this;
    }

    /**
     * @return value-of<FormFieldPaymentConfigChargeOneOffCurrencyEnum>
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param value-of<FormFieldPaymentConfigChargeOneOffCurrencyEnum> $value
     */
    public function setCurrency(string $value): self
    {
        $this->currency = $value;
        $this->_setField('currency');
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
