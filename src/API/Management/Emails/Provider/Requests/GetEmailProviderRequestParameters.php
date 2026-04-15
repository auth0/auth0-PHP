<?php

namespace Auth0\SDK\API\Management\Emails\Provider\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetEmailProviderRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (dependent upon include_fields) from the result. Leave empty to retrieve `name` and `enabled`. Additional fields available include `credentials`, `default_from_address`, and `settings`.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
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
