<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for token exchange.
 */
class ClientTokenExchangeConfiguration extends JsonSerializableType
{
    /**
     * @var ?array<value-of<ClientTokenExchangeTypeEnum>> $allowAnyProfileOfType List the enabled token exchange types for this client.
     */
    #[JsonProperty('allow_any_profile_of_type'), ArrayType(['string'])]
    private ?array $allowAnyProfileOfType;

    /**
     * @param array{
     *   allowAnyProfileOfType?: ?array<value-of<ClientTokenExchangeTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->allowAnyProfileOfType = $values['allowAnyProfileOfType'] ?? null;
    }

    /**
     * @return ?array<value-of<ClientTokenExchangeTypeEnum>>
     */
    public function getAllowAnyProfileOfType(): ?array
    {
        return $this->allowAnyProfileOfType;
    }

    /**
     * @param ?array<value-of<ClientTokenExchangeTypeEnum>> $value
     */
    public function setAllowAnyProfileOfType(?array $value = null): self
    {
        $this->allowAnyProfileOfType = $value;
        $this->_setField('allowAnyProfileOfType');
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
