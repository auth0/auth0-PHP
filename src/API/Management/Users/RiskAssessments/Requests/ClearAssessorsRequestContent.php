<?php

namespace Auth0\SDK\API\Management\Users\RiskAssessments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AssessorsTypeEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ClearAssessorsRequestContent extends JsonSerializableType
{
    /**
     * @var string $connection The name of the connection containing the user whose assessors should be cleared.
     */
    #[JsonProperty('connection')]
    private string $connection;

    /**
     * @var array<value-of<AssessorsTypeEnum>> $assessors List of assessors to clear.
     */
    #[JsonProperty('assessors'), ArrayType(['string'])]
    private array $assessors;

    /**
     * @param array{
     *   connection: string,
     *   assessors: array<value-of<AssessorsTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connection = $values['connection'];
        $this->assessors = $values['assessors'];
    }

    /**
     * @return string
     */
    public function getConnection(): string
    {
        return $this->connection;
    }

    /**
     * @param string $value
     */
    public function setConnection(string $value): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return array<value-of<AssessorsTypeEnum>>
     */
    public function getAssessors(): array
    {
        return $this->assessors;
    }

    /**
     * @param array<value-of<AssessorsTypeEnum>> $value
     */
    public function setAssessors(array $value): self
    {
        $this->assessors = $value;
        $this->_setField('assessors');
        return $this;
    }
}
