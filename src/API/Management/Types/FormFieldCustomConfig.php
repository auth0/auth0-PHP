<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldCustomConfig extends JsonSerializableType
{
    /**
     * @var array<string, mixed> $schema
     */
    #[JsonProperty('schema'), ArrayType(['string' => 'mixed'])]
    private array $schema;

    /**
     * @var string $code
     */
    #[JsonProperty('code')]
    private string $code;

    /**
     * @var ?string $css
     */
    #[JsonProperty('css')]
    private ?string $css;

    /**
     * @var ?array<string, string> $params
     */
    #[JsonProperty('params'), ArrayType(['string' => 'string'])]
    private ?array $params;

    /**
     * @param array{
     *   schema: array<string, mixed>,
     *   code: string,
     *   css?: ?string,
     *   params?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->schema = $values['schema'];
        $this->code = $values['code'];
        $this->css = $values['css'] ?? null;
        $this->params = $values['params'] ?? null;
    }

    /**
     * @return array<string, mixed>
     */
    public function getSchema(): array
    {
        return $this->schema;
    }

    /**
     * @param array<string, mixed> $value
     */
    public function setSchema(array $value): self
    {
        $this->schema = $value;
        $this->_setField('schema');
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $value
     */
    public function setCode(string $value): self
    {
        $this->code = $value;
        $this->_setField('code');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCss(): ?string
    {
        return $this->css;
    }

    /**
     * @param ?string $value
     */
    public function setCss(?string $value = null): self
    {
        $this->css = $value;
        $this->_setField('css');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getParams(): ?array
    {
        return $this->params;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setParams(?array $value = null): self
    {
        $this->params = $value;
        $this->_setField('params');
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
