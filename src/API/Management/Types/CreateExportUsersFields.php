<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateExportUsersFields extends JsonSerializableType
{
    /**
     * @var string $name Name of the field in the profile.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $exportAs Title of the column in the exported CSV.
     */
    #[JsonProperty('export_as')]
    private ?string $exportAs;

    /**
     * @param array{
     *   name: string,
     *   exportAs?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->exportAs = $values['exportAs'] ?? null;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExportAs(): ?string
    {
        return $this->exportAs;
    }

    /**
     * @param ?string $value
     */
    public function setExportAs(?string $value = null): self
    {
        $this->exportAs = $value;
        $this->_setField('exportAs');
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
