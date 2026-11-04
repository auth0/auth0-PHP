<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Whether matched clients default to requiring proof of possession.
 */
class ClientProfileClientConfigurationRequireProofOfPossession extends JsonSerializableType
{
    /**
     * @var ?bool $defaultValue
     */
    #[JsonProperty('default_value')]
    private ?bool $defaultValue;

    /**
     * @param array{
     *   defaultValue?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->defaultValue = $values['defaultValue'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getDefaultValue(): ?bool
    {
        return $this->defaultValue;
    }

    /**
     * @param ?bool $value
     */
    public function setDefaultValue(?bool $value = null): self
    {
        $this->defaultValue = $value;
        $this->_setField('defaultValue');
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
