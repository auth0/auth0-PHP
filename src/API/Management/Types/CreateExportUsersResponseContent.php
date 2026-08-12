<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateExportUsersResponseContent extends JsonSerializableType
{
    /**
     * @var string $status Status of this job.
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @var string $type Type of job this is.
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var ?string $createdAt When this job was created.
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @var string $id ID of this job.
     */
    #[JsonProperty('id')]
    private string $id;

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
     *   status: string,
     *   type: string,
     *   id: string,
     *   createdAt?: ?string,
     *   connectionId?: ?string,
     *   format?: ?value-of<JobFileFormatEnum>,
     *   limit?: ?int,
     *   fields?: ?array<CreateExportUsersFields>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
        $this->type = $values['type'];
        $this->createdAt = $values['createdAt'] ?? null;
        $this->id = $values['id'];
        $this->connectionId = $values['connectionId'] ?? null;
        $this->format = $values['format'] ?? null;
        $this->limit = $values['limit'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
