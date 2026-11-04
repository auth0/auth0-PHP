<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0StructureSeparator extends JsonSerializableType
{
    /**
     * @var ?PageComponentAuth0StructureSeparatorConfig $config
     */
    #[JsonProperty('config')]
    private ?PageComponentAuth0StructureSeparatorConfig $config;

    /**
     * @param array{
     *   config?: ?PageComponentAuth0StructureSeparatorConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->config = $values['config'] ?? null;
    }

    /**
     * @return ?PageComponentAuth0StructureSeparatorConfig
     */
    public function getConfig(): ?PageComponentAuth0StructureSeparatorConfig
    {
        return $this->config;
    }

    /**
     * @param ?PageComponentAuth0StructureSeparatorConfig $value
     */
    public function setConfig(?PageComponentAuth0StructureSeparatorConfig $value = null): self
    {
        $this->config = $value;
        $this->_setField('config');
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
