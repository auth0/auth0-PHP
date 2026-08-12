<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Providers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\PhoneProviderDeliveryMethodEnum;

class CreatePhoneProviderSendTestRequestContent extends JsonSerializableType
{
    /**
     * @var string $to The recipient phone number to receive a given notification.
     */
    #[JsonProperty('to')]
    private string $to;

    /**
     * @var ?value-of<PhoneProviderDeliveryMethodEnum> $deliveryMethod
     */
    #[JsonProperty('delivery_method')]
    private ?string $deliveryMethod;

    /**
     * @param array{
     *   to: string,
     *   deliveryMethod?: ?value-of<PhoneProviderDeliveryMethodEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->to = $values['to'];
        $this->deliveryMethod = $values['deliveryMethod'] ?? null;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $value
     */
    public function setTo(string $value): self
    {
        $this->to = $value;
        $this->_setField('to');
        return $this;
    }

    /**
     * @return ?value-of<PhoneProviderDeliveryMethodEnum>
     */
    public function getDeliveryMethod(): ?string
    {
        return $this->deliveryMethod;
    }

    /**
     * @param ?value-of<PhoneProviderDeliveryMethodEnum> $value
     */
    public function setDeliveryMethod(?string $value = null): self
    {
        $this->deliveryMethod = $value;
        $this->_setField('deliveryMethod');
        return $this;
    }
}
