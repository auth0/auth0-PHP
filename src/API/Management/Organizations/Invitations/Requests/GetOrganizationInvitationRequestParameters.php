<?php

namespace Auth0\SDK\API\Management\Organizations\Invitations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetOrganizationInvitationRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false). Defaults to true.
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
