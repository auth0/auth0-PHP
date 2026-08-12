<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionStripeAddress extends JsonSerializableType
{
    /**
     * @var ?string $line1
     */
    #[JsonProperty('line1')]
    private ?string $line1;

    /**
     * @var ?string $line2
     */
    #[JsonProperty('line2')]
    private ?string $line2;

    /**
     * @var ?string $postalCode
     */
    #[JsonProperty('postalCode')]
    private ?string $postalCode;

    /**
     * @var ?string $city
     */
    #[JsonProperty('city')]
    private ?string $city;

    /**
     * @var ?string $state
     */
    #[JsonProperty('state')]
    private ?string $state;

    /**
     * @var ?string $country
     */
    #[JsonProperty('country')]
    private ?string $country;

    /**
     * @param array{
     *   line1?: ?string,
     *   line2?: ?string,
     *   postalCode?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   country?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->line1 = $values['line1'] ?? null;
        $this->line2 = $values['line2'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->country = $values['country'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getLine1(): ?string
    {
        return $this->line1;
    }

    /**
     * @param ?string $value
     */
    public function setLine1(?string $value = null): self
    {
        $this->line1 = $value;
        $this->_setField('line1');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLine2(): ?string
    {
        return $this->line2;
    }

    /**
     * @param ?string $value
     */
    public function setLine2(?string $value = null): self
    {
        $this->line2 = $value;
        $this->_setField('line2');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param ?string $value
     */
    public function setPostalCode(?string $value = null): self
    {
        $this->postalCode = $value;
        $this->_setField('postalCode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param ?string $value
     */
    public function setCity(?string $value = null): self
    {
        $this->city = $value;
        $this->_setField('city');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param ?string $value
     */
    public function setState(?string $value = null): self
    {
        $this->state = $value;
        $this->_setField('state');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param ?string $value
     */
    public function setCountry(?string $value = null): self
    {
        $this->country = $value;
        $this->_setField('country');
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
