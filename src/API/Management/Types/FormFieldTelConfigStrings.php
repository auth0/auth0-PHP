<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormFieldTelConfigStrings extends JsonSerializableType
{
    /**
     * @var ?string $filterPlaceholder
     */
    #[JsonProperty('filter_placeholder')]
    private ?string $filterPlaceholder;

    /**
     * @param array{
     *   filterPlaceholder?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->filterPlaceholder = $values['filterPlaceholder'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFilterPlaceholder(): ?string
    {
        return $this->filterPlaceholder;
    }

    /**
     * @param ?string $value
     */
    public function setFilterPlaceholder(?string $value = null): self
    {
        $this->filterPlaceholder = $value;
        $this->_setField('filterPlaceholder');
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
