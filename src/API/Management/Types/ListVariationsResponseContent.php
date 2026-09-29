<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListVariationsResponseContent extends JsonSerializableType
{
    /**
     * @var array<Variation> $variations
     */
    #[JsonProperty('variations'), ArrayType([Variation::class])]
    private array $variations;

    /**
     * @param array{
     *   variations: array<Variation>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->variations = $values['variations'];
    }

    /**
     * @return array<Variation>
     */
    public function getVariations(): array
    {
        return $this->variations;
    }

    /**
     * @param array<Variation> $value
     */
    public function setVariations(array $value): self
    {
        $this->variations = $value;
        $this->_setField('variations');
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
