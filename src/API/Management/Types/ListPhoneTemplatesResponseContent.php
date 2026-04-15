<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListPhoneTemplatesResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<PhoneTemplate> $templates
     */
    #[JsonProperty('templates'), ArrayType([PhoneTemplate::class])]
    private ?array $templates;

    /**
     * @param array{
     *   templates?: ?array<PhoneTemplate>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->templates = $values['templates'] ?? null;
    }

    /**
     * @return ?array<PhoneTemplate>
     */
    public function getTemplates(): ?array
    {
        return $this->templates;
    }

    /**
     * @param ?array<PhoneTemplate> $value
     */
    public function setTemplates(?array $value = null): self
    {
        $this->templates = $value;
        $this->_setField('templates');
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
