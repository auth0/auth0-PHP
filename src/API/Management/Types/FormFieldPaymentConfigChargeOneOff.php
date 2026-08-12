<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldPaymentConfigChargeOneOff extends JsonSerializableType
{
    /**
     * @var value-of<FormFieldPaymentConfigChargeTypeOneOffConst> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var FormFieldPaymentConfigChargeOneOffOneOff $oneOff
     */
    #[JsonProperty('one_off')]
    private FormFieldPaymentConfigChargeOneOffOneOff $oneOff;

    /**
     * @param array{
     *   type: value-of<FormFieldPaymentConfigChargeTypeOneOffConst>,
     *   oneOff: FormFieldPaymentConfigChargeOneOffOneOff,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->oneOff = $values['oneOff'];
    }

    /**
     * @return value-of<FormFieldPaymentConfigChargeTypeOneOffConst>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FormFieldPaymentConfigChargeTypeOneOffConst> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return FormFieldPaymentConfigChargeOneOffOneOff
     */
    public function getOneOff(): FormFieldPaymentConfigChargeOneOffOneOff
    {
        return $this->oneOff;
    }

    /**
     * @param FormFieldPaymentConfigChargeOneOffOneOff $value
     */
    public function setOneOff(FormFieldPaymentConfigChargeOneOffOneOff $value): self
    {
        $this->oneOff = $value;
        $this->_setField('oneOff');
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
