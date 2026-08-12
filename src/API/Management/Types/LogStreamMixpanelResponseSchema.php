<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class LogStreamMixpanelResponseSchema extends JsonSerializableType
{
    /**
     * @var ?string $id The id of the log stream
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name log stream name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?value-of<LogStreamStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?value-of<LogStreamMixpanelEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?bool $isPriority True for priority log streams, false for non-priority
     */
    #[JsonProperty('isPriority')]
    private ?bool $isPriority;

    /**
     * @var ?array<LogStreamFilter> $filters Only logs events matching these filters will be delivered by the stream. If omitted or empty, all events will be delivered.
     */
    #[JsonProperty('filters'), ArrayType([LogStreamFilter::class])]
    private ?array $filters;

    /**
     * @var ?LogStreamPiiConfig $piiConfig
     */
    #[JsonProperty('pii_config')]
    private ?LogStreamPiiConfig $piiConfig;

    /**
     * @var ?LogStreamMixpanelSink $sink
     */
    #[JsonProperty('sink')]
    private ?LogStreamMixpanelSink $sink;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   status?: ?value-of<LogStreamStatusEnum>,
     *   type?: ?value-of<LogStreamMixpanelEnum>,
     *   isPriority?: ?bool,
     *   filters?: ?array<LogStreamFilter>,
     *   piiConfig?: ?LogStreamPiiConfig,
     *   sink?: ?LogStreamMixpanelSink,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->isPriority = $values['isPriority'] ?? null;
        $this->filters = $values['filters'] ?? null;
        $this->piiConfig = $values['piiConfig'] ?? null;
        $this->sink = $values['sink'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<LogStreamStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?value-of<LogStreamMixpanelEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<LogStreamMixpanelEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsPriority(): ?bool
    {
        return $this->isPriority;
    }

    /**
     * @param ?bool $value
     */
    public function setIsPriority(?bool $value = null): self
    {
        $this->isPriority = $value;
        $this->_setField('isPriority');
        return $this;
    }

    /**
     * @return ?array<LogStreamFilter>
     */
    public function getFilters(): ?array
    {
        return $this->filters;
    }

    /**
     * @param ?array<LogStreamFilter> $value
     */
    public function setFilters(?array $value = null): self
    {
        $this->filters = $value;
        $this->_setField('filters');
        return $this;
    }

    /**
     * @return ?LogStreamPiiConfig
     */
    public function getPiiConfig(): ?LogStreamPiiConfig
    {
        return $this->piiConfig;
    }

    /**
     * @param ?LogStreamPiiConfig $value
     */
    public function setPiiConfig(?LogStreamPiiConfig $value = null): self
    {
        $this->piiConfig = $value;
        $this->_setField('piiConfig');
        return $this;
    }

    /**
     * @return ?LogStreamMixpanelSink
     */
    public function getSink(): ?LogStreamMixpanelSink
    {
        return $this->sink;
    }

    /**
     * @param ?LogStreamMixpanelSink $value
     */
    public function setSink(?LogStreamMixpanelSink $value = null): self
    {
        $this->sink = $value;
        $this->_setField('sink');
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
