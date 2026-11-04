<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0StructureSection extends JsonSerializableType
{
    /**
     * @var PageComponentAuth0StructureSectionConfig $config
     */
    #[JsonProperty('config')]
    private PageComponentAuth0StructureSectionConfig $config;

    /**
     * @param array{
     *   config: PageComponentAuth0StructureSectionConfig,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->config = $values['config'];
    }

    /**
     * @return PageComponentAuth0StructureSectionConfig
     */
    public function getConfig(): PageComponentAuth0StructureSectionConfig
    {
        return $this->config;
    }

    /**
     * @param PageComponentAuth0StructureSectionConfig $value
     */
    public function setConfig(PageComponentAuth0StructureSectionConfig $value): self
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
