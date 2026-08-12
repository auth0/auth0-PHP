<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class TwilioProviderConfiguration extends JsonSerializableType
{
    /**
     * @var ?string $defaultFrom
     */
    #[JsonProperty('default_from')]
    private ?string $defaultFrom;

    /**
     * @var ?string $mssid
     */
    #[JsonProperty('mssid')]
    private ?string $mssid;

    /**
     * @var string $sid
     */
    #[JsonProperty('sid')]
    private string $sid;

    /**
     * @var array<value-of<TwilioProviderDeliveryMethodEnum>> $deliveryMethods
     */
    #[JsonProperty('delivery_methods'), ArrayType(['string'])]
    private array $deliveryMethods;

    /**
     * @param array{
     *   sid: string,
     *   deliveryMethods: array<value-of<TwilioProviderDeliveryMethodEnum>>,
     *   defaultFrom?: ?string,
     *   mssid?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->defaultFrom = $values['defaultFrom'] ?? null;
        $this->mssid = $values['mssid'] ?? null;
        $this->sid = $values['sid'];
        $this->deliveryMethods = $values['deliveryMethods'];
    }

    /**
     * @return ?string
     */
    public function getDefaultFrom(): ?string
    {
        return $this->defaultFrom;
    }

    /**
     * @param ?string $value
     */
    public function setDefaultFrom(?string $value = null): self
    {
        $this->defaultFrom = $value;
        $this->_setField('defaultFrom');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getMssid(): ?string
    {
        return $this->mssid;
    }

    /**
     * @param ?string $value
     */
    public function setMssid(?string $value = null): self
    {
        $this->mssid = $value;
        $this->_setField('mssid');
        return $this;
    }

    /**
     * @return string
     */
    public function getSid(): string
    {
        return $this->sid;
    }

    /**
     * @param string $value
     */
    public function setSid(string $value): self
    {
        $this->sid = $value;
        $this->_setField('sid');
        return $this;
    }

    /**
     * @return array<value-of<TwilioProviderDeliveryMethodEnum>>
     */
    public function getDeliveryMethods(): array
    {
        return $this->deliveryMethods;
    }

    /**
     * @param array<value-of<TwilioProviderDeliveryMethodEnum>> $value
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
