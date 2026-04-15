<?php

namespace Auth0\SDK\API\Management\Connections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetConnectionRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields <code>true</code> if the fields specified are to be included in the result, <code>false</code> otherwise (defaults to <code>true</code>)
     */
    private ?bool $includeFields;

    /**
     * @param array{
     *   fields?: ?string,
     *   includeFields?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * @param ?string $value
     */
    public function setFields(?string $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeFields(?bool $value = null): self
    {
        $this->includeFields = $value;
        $this->_setField('includeFields');
        return $this;
    }
}
