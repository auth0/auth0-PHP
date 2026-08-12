<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionMailjetSendEmailParamsTemplateId extends JsonSerializableType
{
    /**
     * @var int $templateId
     */
    #[JsonProperty('template_id')]
    private int $templateId;

    /**
     * @var ?array<string, mixed> $variables
     */
    #[JsonProperty('variables'), ArrayType(['string' => 'mixed'])]
    private ?array $variables;

    /**
     * @param array{
     *   templateId: int,
     *   variables?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->templateId = $values['templateId'];
        $this->variables = $values['variables'] ?? null;
    }

    /**
     * @return int
     */
    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    /**
     * @param int $value
     */
    public function setTemplateId(int $value): self
    {
        $this->templateId = $value;
        $this->_setField('templateId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getVariables(): ?array
    {
        return $this->variables;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setVariables(?array $value = null): self
    {
        $this->variables = $value;
        $this->_setField('variables');
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
