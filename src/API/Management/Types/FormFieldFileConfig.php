<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FormFieldFileConfig extends JsonSerializableType
{
    /**
     * @var ?bool $multiple
     */
    #[JsonProperty('multiple')]
    private ?bool $multiple;

    /**
     * @var ?FormFieldFileConfigStorage $storage
     */
    #[JsonProperty('storage')]
    private ?FormFieldFileConfigStorage $storage;

    /**
     * @var ?array<value-of<FormFieldFileConfigCategoryEnum>> $categories
     */
    #[JsonProperty('categories'), ArrayType(['string'])]
    private ?array $categories;

    /**
     * @var ?array<string> $extensions
     */
    #[JsonProperty('extensions'), ArrayType(['string'])]
    private ?array $extensions;

    /**
     * @var ?int $maxSize
     */
    #[JsonProperty('maxSize')]
    private ?int $maxSize;

    /**
     * @var ?int $maxFiles
     */
    #[JsonProperty('maxFiles')]
    private ?int $maxFiles;

    /**
     * @param array{
     *   multiple?: ?bool,
     *   storage?: ?FormFieldFileConfigStorage,
     *   categories?: ?array<value-of<FormFieldFileConfigCategoryEnum>>,
     *   extensions?: ?array<string>,
     *   maxSize?: ?int,
     *   maxFiles?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->multiple = $values['multiple'] ?? null;
        $this->storage = $values['storage'] ?? null;
        $this->categories = $values['categories'] ?? null;
        $this->extensions = $values['extensions'] ?? null;
        $this->maxSize = $values['maxSize'] ?? null;
        $this->maxFiles = $values['maxFiles'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getMultiple(): ?bool
    {
        return $this->multiple;
    }

    /**
     * @param ?bool $value
     */
    public function setMultiple(?bool $value = null): self
    {
        $this->multiple = $value;
        $this->_setField('multiple');
        return $this;
    }

    /**
     * @return ?FormFieldFileConfigStorage
     */
    public function getStorage(): ?FormFieldFileConfigStorage
    {
        return $this->storage;
    }

    /**
     * @param ?FormFieldFileConfigStorage $value
     */
    public function setStorage(?FormFieldFileConfigStorage $value = null): self
    {
        $this->storage = $value;
        $this->_setField('storage');
        return $this;
    }

    /**
     * @return ?array<value-of<FormFieldFileConfigCategoryEnum>>
     */
    public function getCategories(): ?array
    {
        return $this->categories;
    }

    /**
     * @param ?array<value-of<FormFieldFileConfigCategoryEnum>> $value
     */
    public function setCategories(?array $value = null): self
    {
        $this->categories = $value;
        $this->_setField('categories');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getExtensions(): ?array
    {
        return $this->extensions;
    }

    /**
     * @param ?array<string> $value
     */
    public function setExtensions(?array $value = null): self
    {
        $this->extensions = $value;
        $this->_setField('extensions');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    /**
     * @param ?int $value
     */
    public function setMaxSize(?int $value = null): self
    {
        $this->maxSize = $value;
        $this->_setField('maxSize');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxFiles(): ?int
    {
        return $this->maxFiles;
    }

    /**
     * @param ?int $value
     */
    public function setMaxFiles(?int $value = null): self
    {
        $this->maxFiles = $value;
        $this->_setField('maxFiles');
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
