<?php

namespace Auth0\SDK\API\Management\Prompts\Rendering\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\AculRenderingModeEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\AculContextEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\AculHeadTag;
use Auth0\SDK\API\Management\Types\AculFilters;

class UpdateAculRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<AculRenderingModeEnum> $renderingMode Rendering mode
     */
    #[JsonProperty('rendering_mode')]
    private ?string $renderingMode;

    /**
     * @var ?array<(
     *    value-of<AculContextEnum>
     *   |string
     * )> $contextConfiguration
     */
    #[JsonProperty('context_configuration'), ArrayType(['string'])]
    private ?array $contextConfiguration;

    /**
     * @var ?bool $defaultHeadTagsDisabled Override Universal Login default head tags
     */
    #[JsonProperty('default_head_tags_disabled')]
    private ?bool $defaultHeadTagsDisabled;

    /**
     * @var ?bool $usePageTemplate Use page template with ACUL
     */
    #[JsonProperty('use_page_template')]
    private ?bool $usePageTemplate;

    /**
     * @var ?array<AculHeadTag> $headTags An array of head tags
     */
    #[JsonProperty('head_tags'), ArrayType([AculHeadTag::class])]
    private ?array $headTags;

    /**
     * @var ?AculFilters $filters
     */
    #[JsonProperty('filters')]
    private ?AculFilters $filters;

    /**
     * @param array{
     *   renderingMode?: ?value-of<AculRenderingModeEnum>,
     *   contextConfiguration?: ?array<(
     *    value-of<AculContextEnum>
     *   |string
     * )>,
     *   defaultHeadTagsDisabled?: ?bool,
     *   usePageTemplate?: ?bool,
     *   headTags?: ?array<AculHeadTag>,
     *   filters?: ?AculFilters,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->renderingMode = $values['renderingMode'] ?? null;
        $this->contextConfiguration = $values['contextConfiguration'] ?? null;
        $this->defaultHeadTagsDisabled = $values['defaultHeadTagsDisabled'] ?? null;
        $this->usePageTemplate = $values['usePageTemplate'] ?? null;
        $this->headTags = $values['headTags'] ?? null;
        $this->filters = $values['filters'] ?? null;
    }

    /**
     * @return ?value-of<AculRenderingModeEnum>
     */
    public function getRenderingMode(): ?string
    {
        return $this->renderingMode;
    }

    /**
     * @param ?value-of<AculRenderingModeEnum> $value
     */
    public function setRenderingMode(?string $value = null): self
    {
        $this->renderingMode = $value;
        $this->_setField('renderingMode');
        return $this;
    }

    /**
     * @return ?array<(
     *    value-of<AculContextEnum>
     *   |string
     * )>
     */
    public function getContextConfiguration(): ?array
    {
        return $this->contextConfiguration;
    }

    /**
     * @param ?array<(
     *    value-of<AculContextEnum>
     *   |string
     * )> $value
     */
    public function setContextConfiguration(?array $value = null): self
    {
        $this->contextConfiguration = $value;
        $this->_setField('contextConfiguration');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDefaultHeadTagsDisabled(): ?bool
    {
        return $this->defaultHeadTagsDisabled;
    }

    /**
     * @param ?bool $value
     */
    public function setDefaultHeadTagsDisabled(?bool $value = null): self
    {
        $this->defaultHeadTagsDisabled = $value;
        $this->_setField('defaultHeadTagsDisabled');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getUsePageTemplate(): ?bool
    {
        return $this->usePageTemplate;
    }

    /**
     * @param ?bool $value
     */
    public function setUsePageTemplate(?bool $value = null): self
    {
        $this->usePageTemplate = $value;
        $this->_setField('usePageTemplate');
        return $this;
    }

    /**
     * @return ?array<AculHeadTag>
     */
    public function getHeadTags(): ?array
    {
        return $this->headTags;
    }

    /**
     * @param ?array<AculHeadTag> $value
     */
    public function setHeadTags(?array $value = null): self
    {
        $this->headTags = $value;
        $this->_setField('headTags');
        return $this;
    }

    /**
     * @return ?AculFilters
     */
    public function getFilters(): ?AculFilters
    {
        return $this->filters;
    }

    /**
     * @param ?AculFilters $value
     */
    public function setFilters(?AculFilters $value = null): self
    {
        $this->filters = $value;
        $this->_setField('filters');
        return $this;
    }
}
