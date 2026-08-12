<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldPaymentConfig extends JsonSerializableType
{
    /**
     * @var ?value-of<FormFieldPaymentConfigProviderEnum> $provider
     */
    #[JsonProperty('provider')]
    private ?string $provider;

    /**
     * @var (
     *    FormFieldPaymentConfigChargeOneOff
     *   |FormFieldPaymentConfigChargeSubscription
     * ) $charge
     */
    #[JsonProperty('charge'), Union(FormFieldPaymentConfigChargeOneOff::class, FormFieldPaymentConfigChargeSubscription::class)]
    private FormFieldPaymentConfigChargeOneOff|FormFieldPaymentConfigChargeSubscription $charge;

    /**
     * @var FormFieldPaymentConfigCredentials $credentials
     */
    #[JsonProperty('credentials')]
    private FormFieldPaymentConfigCredentials $credentials;

    /**
     * @var ?array<string, mixed> $customer
     */
    #[JsonProperty('customer'), ArrayType(['string' => 'mixed'])]
    private ?array $customer;

    /**
     * @var ?FormFieldPaymentConfigFields $fields
     */
    #[JsonProperty('fields')]
    private ?FormFieldPaymentConfigFields $fields;

    /**
     * @param array{
     *   charge: (
     *    FormFieldPaymentConfigChargeOneOff
     *   |FormFieldPaymentConfigChargeSubscription
     * ),
     *   credentials: FormFieldPaymentConfigCredentials,
     *   provider?: ?value-of<FormFieldPaymentConfigProviderEnum>,
     *   customer?: ?array<string, mixed>,
     *   fields?: ?FormFieldPaymentConfigFields,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->provider = $values['provider'] ?? null;
        $this->charge = $values['charge'];
        $this->credentials = $values['credentials'];
        $this->customer = $values['customer'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return ?value-of<FormFieldPaymentConfigProviderEnum>
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @param ?value-of<FormFieldPaymentConfigProviderEnum> $value
     */
    public function setProvider(?string $value = null): self
    {
        $this->provider = $value;
        $this->_setField('provider');
        return $this;
    }

    /**
     * @return (
     *    FormFieldPaymentConfigChargeOneOff
     *   |FormFieldPaymentConfigChargeSubscription
     * )
     */
    public function getCharge(): FormFieldPaymentConfigChargeOneOff|FormFieldPaymentConfigChargeSubscription
    {
        return $this->charge;
    }

    /**
     * @param (
     *    FormFieldPaymentConfigChargeOneOff
     *   |FormFieldPaymentConfigChargeSubscription
     * ) $value
     */
    public function setCharge(FormFieldPaymentConfigChargeOneOff|FormFieldPaymentConfigChargeSubscription $value): self
    {
        $this->charge = $value;
        $this->_setField('charge');
        return $this;
    }

    /**
     * @return FormFieldPaymentConfigCredentials
     */
    public function getCredentials(): FormFieldPaymentConfigCredentials
    {
        return $this->credentials;
    }

    /**
     * @param FormFieldPaymentConfigCredentials $value
     */
    public function setCredentials(FormFieldPaymentConfigCredentials $value): self
    {
        $this->credentials = $value;
        $this->_setField('credentials');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getCustomer(): ?array
    {
        return $this->customer;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setCustomer(?array $value = null): self
    {
        $this->customer = $value;
        $this->_setField('customer');
        return $this;
    }

    /**
     * @return ?FormFieldPaymentConfigFields
     */
    public function getFields(): ?FormFieldPaymentConfigFields
    {
        return $this->fields;
    }

    /**
     * @param ?FormFieldPaymentConfigFields $value
     */
    public function setFields(?FormFieldPaymentConfigFields $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
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
