<?php

namespace Auth0\SDK\API\Management\Hooks\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetHookRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields Comma-separated list of fields to include in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @param array{
     *   fields?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fields = $values['fields'] ?? null;
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
}
