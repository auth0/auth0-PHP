<?php

namespace Auth0\SDK\API\Management\Prompts\Rendering\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\AculRenderingModeEnum;

class ListAculsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (default: true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page. Maximum value is 100, default value is 50.
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total configuration count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $prompt Name of the prompt to filter by
     */
    private ?string $prompt;

    /**
     * @var ?string $screen Name of the screen to filter by
     */
    private ?string $screen;

    /**
     * @var ?value-of<AculRenderingModeEnum> $renderingMode Rendering mode to filter by
     */
    private ?string $renderingMode;

    /**
     * @param array{
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   prompt?: ?string,
     *   screen?: ?string,
     *   renderingMode?: ?value-of<AculRenderingModeEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->prompt = $values['prompt'] ?? null;
        $this->screen = $values['screen'] ?? null;
        $this->renderingMode = $values['renderingMode'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * @param ?string $value
     */
    public function setFields(?string $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeFields(?bool $value = null): self
    {
        $this->includeFields = $value;
        $this->_setField('includeFields');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param ?int $value
     */
    public function setPage(?int $value = null): self
    {
        $this->page = $value;
        $this->_setField('page');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param ?int $value
     */
    public function setPerPage(?int $value = null): self
    {
        $this->perPage = $value;
        $this->_setField('perPage');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->includeTotals;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeTotals(?bool $value = null): self
    {
        $this->includeTotals = $value;
        $this->_setField('includeTotals');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    /**
     * @param ?string $value
     */
    public function setPrompt(?string $value = null): self
    {
        $this->prompt = $value;
        $this->_setField('prompt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScreen(): ?string
    {
        return $this->screen;
    }

    /**
     * @param ?string $value
     */
    public function setScreen(?string $value = null): self
    {
        $this->screen = $value;
        $this->_setField('screen');
        return $this;
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
}
