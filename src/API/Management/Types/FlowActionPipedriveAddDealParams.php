<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionPipedriveAddDealParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $title
     */
    #[JsonProperty('title')]
    private string $title;

    /**
     * @var ?string $value
     */
    #[JsonProperty('value')]
    private ?string $value;

    /**
     * @var (
     *    string
     *   |float
     * )|null $userId
     */
    #[JsonProperty('user_id'), Union('string', 'float', 'null')]
    private string|float|null $userId;

    /**
     * @var (
     *    string
     *   |float
     * )|null $personId
     */
    #[JsonProperty('person_id'), Union('string', 'float', 'null')]
    private string|float|null $personId;

    /**
     * @var (
     *    string
     *   |float
     * )|null $organizationId
     */
    #[JsonProperty('organization_id'), Union('string', 'float', 'null')]
    private string|float|null $organizationId;

    /**
     * @var (
     *    string
     *   |float
     * )|null $stageId
     */
    #[JsonProperty('stage_id'), Union('string', 'float', 'null')]
    private string|float|null $stageId;

    /**
     * @var ?array<string, mixed> $fields
     */
    #[JsonProperty('fields'), ArrayType(['string' => 'mixed'])]
    private ?array $fields;

    /**
     * @param array{
     *   connectionId: string,
     *   title: string,
     *   value?: ?string,
     *   userId?: (
     *    string
     *   |float
     * )|null,
     *   personId?: (
     *    string
     *   |float
     * )|null,
     *   organizationId?: (
     *    string
     *   |float
     * )|null,
     *   stageId?: (
     *    string
     *   |float
     * )|null,
     *   fields?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->title = $values['title'];
        $this->value = $values['value'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->personId = $values['personId'] ?? null;
        $this->organizationId = $values['organizationId'] ?? null;
        $this->stageId = $values['stageId'] ?? null;
        $this->fields = $values['fields'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $value
     */
    public function setTitle(string $value): self
    {
        $this->title = $value;
        $this->_setField('title');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param ?string $value
     */
    public function setValue(?string $value = null): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     * )|null
     */
    public function getUserId(): string|float|null
    {
        return $this->userId;
    }

    /**
     * @param (
     *    string
     *   |float
     * )|null $value
     */
    public function setUserId(string|float|null $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     * )|null
     */
    public function getPersonId(): string|float|null
    {
        return $this->personId;
    }

    /**
     * @param (
     *    string
     *   |float
     * )|null $value
     */
    public function setPersonId(string|float|null $value = null): self
    {
        $this->personId = $value;
        $this->_setField('personId');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     * )|null
     */
    public function getOrganizationId(): string|float|null
    {
        return $this->organizationId;
    }

    /**
     * @param (
     *    string
     *   |float
     * )|null $value
     */
    public function setOrganizationId(string|float|null $value = null): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |float
     * )|null
     */
    public function getStageId(): string|float|null
    {
        return $this->stageId;
    }

    /**
     * @param (
     *    string
     *   |float
     * )|null $value
     */
    public function setStageId(string|float|null $value = null): self
    {
        $this->stageId = $value;
        $this->_setField('stageId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * @param ?array<string, mixed> $value
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
