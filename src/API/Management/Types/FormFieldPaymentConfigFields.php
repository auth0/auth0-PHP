<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldPaymentConfigFields extends JsonSerializableType
{
    /**
     * @var ?FormFieldPaymentConfigFieldProperties $cardNumber
     */
    #[JsonProperty('card_number')]
    private ?FormFieldPaymentConfigFieldProperties $cardNumber;

    /**
     * @var ?FormFieldPaymentConfigFieldProperties $expirationDate
     */
    #[JsonProperty('expiration_date')]
    private ?FormFieldPaymentConfigFieldProperties $expirationDate;

    /**
     * @var ?FormFieldPaymentConfigFieldProperties $securityCode
     */
    #[JsonProperty('security_code')]
    private ?FormFieldPaymentConfigFieldProperties $securityCode;

    /**
     * @var ?bool $trustmarks
     */
    #[JsonProperty('trustmarks')]
    private ?bool $trustmarks;

    /**
     * @param array{
     *   cardNumber?: ?FormFieldPaymentConfigFieldProperties,
     *   expirationDate?: ?FormFieldPaymentConfigFieldProperties,
     *   securityCode?: ?FormFieldPaymentConfigFieldProperties,
     *   trustmarks?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->cardNumber = $values['cardNumber'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->securityCode = $values['securityCode'] ?? null;
        $this->trustmarks = $values['trustmarks'] ?? null;
    }

    /**
     * @return ?FormFieldPaymentConfigFieldProperties
     */
    public function getCardNumber(): ?FormFieldPaymentConfigFieldProperties
    {
        return $this->cardNumber;
    }

    /**
     * @param ?FormFieldPaymentConfigFieldProperties $value
     */
    public function setCardNumber(?FormFieldPaymentConfigFieldProperties $value = null): self
    {
        $this->cardNumber = $value;
        $this->_setField('cardNumber');
        return $this;
    }

    /**
     * @return ?FormFieldPaymentConfigFieldProperties
     */
    public function getExpirationDate(): ?FormFieldPaymentConfigFieldProperties
    {
        return $this->expirationDate;
    }

    /**
     * @param ?FormFieldPaymentConfigFieldProperties $value
     */
    public function setExpirationDate(?FormFieldPaymentConfigFieldProperties $value = null): self
    {
        $this->expirationDate = $value;
        $this->_setField('expirationDate');
        return $this;
    }

    /**
     * @return ?FormFieldPaymentConfigFieldProperties
     */
    public function getSecurityCode(): ?FormFieldPaymentConfigFieldProperties
    {
        return $this->securityCode;
    }

    /**
     * @param ?FormFieldPaymentConfigFieldProperties $value
     */
    public function setSecurityCode(?FormFieldPaymentConfigFieldProperties $value = null): self
    {
        $this->securityCode = $value;
        $this->_setField('securityCode');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getTrustmarks(): ?bool
    {
        return $this->trustmarks;
    }

    /**
     * @param ?bool $value
     */
    public function setTrustmarks(?bool $value = null): self
    {
        $this->trustmarks = $value;
        $this->_setField('trustmarks');
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
