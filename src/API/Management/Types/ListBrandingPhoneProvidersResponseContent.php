<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListBrandingPhoneProvidersResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<PhoneProviderSchemaMasked> $providers
     */
    #[JsonProperty('providers'), ArrayType([PhoneProviderSchemaMasked::class])]
    private ?array $providers;

    /**
     * @param array{
     *   providers?: ?array<PhoneProviderSchemaMasked>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->providers = $values['providers'] ?? null;
    }

    /**
     * @return ?array<PhoneProviderSchemaMasked>
     */
    public function getProviders(): ?array
    {
        return $this->providers;
    }

    /**
     * @param ?array<PhoneProviderSchemaMasked> $value
     */
    public function setProviders(?array $value = null): self
    {
        $this->providers = $value;
        $this->_setField('providers');
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
