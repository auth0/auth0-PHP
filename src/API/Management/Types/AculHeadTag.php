<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class AculHeadTag extends JsonSerializableType
{
    /**
     * @var ?string $tag Any HTML element valid for use in the head tag
     */
    #[JsonProperty('tag')]
    private ?string $tag;

    /**
     * @var ?array<string, mixed> $attributes
     */
    #[JsonProperty('attributes'), ArrayType(['string' => 'mixed'])]
    private ?array $attributes;

    /**
     * @var ?string $content
     */
    #[JsonProperty('content')]
    private ?string $content;

    /**
     * @param array{
     *   tag?: ?string,
     *   attributes?: ?array<string, mixed>,
     *   content?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tag = $values['tag'] ?? null;
        $this->attributes = $values['attributes'] ?? null;
        $this->content = $values['content'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param ?string $value
     */
    public function setTag(?string $value = null): self
    {
        $this->tag = $value;
        $this->_setField('tag');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setAttributes(?array $value = null): self
    {
        $this->attributes = $value;
        $this->_setField('attributes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param ?string $value
     */
    public function setContent(?string $value = null): self
    {
        $this->content = $value;
        $this->_setField('content');
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
