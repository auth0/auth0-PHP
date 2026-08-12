<?php

namespace Auth0\SDK\API\Management\Jobs\UsersExports\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\JobFileFormatEnum;
use Auth0\SDK\API\Management\Types\CreateExportUsersFields;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateExportUsersRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $connectionId connection_id of the connection from which users will be exported.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?value-of<JobFileFormatEnum> $format
     */
    #[JsonProperty('format')]
    private ?string $format;

    /**
     * @var ?int $limit Limit the number of records.
     */
    #[JsonProperty('limit')]
    private ?int $limit;

    /**
     * @var ?array<CreateExportUsersFields> $fields List of fields to be included in the CSV. Defaults to a predefined set of fields.
     */
    #[JsonProperty('fields'), ArrayType([CreateExportUsersFields::class])]
    private ?array $fields;

    /**
     * @param array{
     *   connectionId?: ?string,
     *   format?: ?value-of<JobFileFormatEnum>,
     *   limit?: ?int,
     *   fields?: ?array<CreateExportUsersFields>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connectionId = $values['connectionId'] ?? null;
        $this->format = $values['format'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?value-of<JobFileFormatEnum>
     */
    public function getFormat(): ?string
    {
        return $this->format;
    }

    /**
     * @param ?value-of<JobFileFormatEnum> $value
     */
    public function setFormat(?string $value = null): self
    {
        $this->format = $value;
        $this->_setField('format');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * @param ?int $value
     */
    public function setLimit(?int $value = null): self
    {
        $this->limit = $value;
        $this->_setField('limit');
        return $this;
    }

    /**
     * @return ?array<CreateExportUsersFields>
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param ?array<CreateExportUsersFields> $value
     */
    public function setFields(?array $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
        return $this;
    }
}
