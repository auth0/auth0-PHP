<?php

namespace Auth0\SDK\API\Management\Connections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ConnectionStrategyEnum;

class ListConnectionsQueryParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?array<?value-of<ConnectionStrategyEnum>> $strategy Provide strategies to only retrieve connections with such strategies
     */
    private ?array $strategy;

    /**
     * @var ?string $name Provide the name of the connection to retrieve
     */
    private ?string $name;

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
     *   from?: ?string,
     *   take?: ?int,
     *   strategy?: ?array<?value-of<ConnectionStrategyEnum>>,
     *   name?: ?string,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->strategy = $values['strategy'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
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

    /**
     * @return ?array<?value-of<ConnectionStrategyEnum>>
     */
    public function getStrategy(): ?array
    {
        return $this->strategy;
    }

    /**
     * @param ?array<?value-of<ConnectionStrategyEnum>> $value
     */
    public function setStrategy(?array $value = null): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
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
