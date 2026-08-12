<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class LogStreamPiiConfig extends JsonSerializableType
{
    /**
     * @var array<value-of<LogStreamPiiLogFieldsEnum>> $logFields
     */
    #[JsonProperty('log_fields'), ArrayType(['string'])]
    private array $logFields;

    /**
     * @var ?value-of<LogStreamPiiMethodEnum> $method
     */
    #[JsonProperty('method')]
    private ?string $method;

    /**
     * @var ?value-of<LogStreamPiiAlgorithmEnum> $algorithm
     */
    #[JsonProperty('algorithm')]
    private ?string $algorithm;

    /**
     * @param array{
     *   logFields: array<value-of<LogStreamPiiLogFieldsEnum>>,
     *   method?: ?value-of<LogStreamPiiMethodEnum>,
     *   algorithm?: ?value-of<LogStreamPiiAlgorithmEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->logFields = $values['logFields'];
        $this->method = $values['method'] ?? null;
        $this->algorithm = $values['algorithm'] ?? null;
    }

    /**
     * @return array<value-of<LogStreamPiiLogFieldsEnum>>
     */
    public function getLogFields(): array
    {
        return $this->logFields;
    }

    /**
     * @param array<value-of<LogStreamPiiLogFieldsEnum>> $value
     */
    public function setLogFields(array $value): self
    {
        $this->logFields = $value;
        $this->_setField('logFields');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamPiiMethodEnum>
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @param ?value-of<LogStreamPiiMethodEnum> $value
     */
    public function setMethod(?string $value = null): self
    {
        $this->method = $value;
        $this->_setField('method');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamPiiAlgorithmEnum>
     */
    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    /**
     * @param ?value-of<LogStreamPiiAlgorithmEnum> $value
     */
    public function setAlgorithm(?string $value = null): self
    {
        $this->algorithm = $value;
        $this->_setField('algorithm');
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
