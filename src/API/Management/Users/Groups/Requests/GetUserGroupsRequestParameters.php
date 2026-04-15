<?php

namespace Auth0\SDK\API\Management\Users\Groups\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetUserGroupsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields A comma separated list of fields to include or exclude (depending on include_fields) from the result, empty to retrieve all fields
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @param array{
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   from?: ?string,
     *   take?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
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

    /**
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
        return $this;
    }
}
