<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateLogStreamMixpanelRequestBody extends JsonSerializableType
{
    /**
     * @var ?string $name log stream name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var value-of<LogStreamMixpanelEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

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
     * @var LogStreamMixpanelSink $sink
     */
    #[JsonProperty('sink')]
    private LogStreamMixpanelSink $sink;

    /**
     * @var ?string $startFrom The optional datetime (ISO 8601) to start streaming logs from
     */
    #[JsonProperty('startFrom')]
    private ?string $startFrom;

    /**
     * @param array{
     *   type: value-of<LogStreamMixpanelEnum>,
     *   sink: LogStreamMixpanelSink,
     *   name?: ?string,
     *   isPriority?: ?bool,
     *   filters?: ?array<LogStreamFilter>,
     *   piiConfig?: ?LogStreamPiiConfig,
     *   startFrom?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'] ?? null;
        $this->type = $values['type'];
        $this->isPriority = $values['isPriority'] ?? null;
        $this->filters = $values['filters'] ?? null;
        $this->piiConfig = $values['piiConfig'] ?? null;
        $this->sink = $values['sink'];
        $this->startFrom = $values['startFrom'] ?? null;
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
     * @return value-of<LogStreamMixpanelEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<LogStreamMixpanelEnum> $value
     */
    public function setType(string $value): self
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
     * @return LogStreamMixpanelSink
     */
    public function getSink(): LogStreamMixpanelSink
    {
        return $this->sink;
    }

    /**
     * @param LogStreamMixpanelSink $value
     */
    public function setSink(LogStreamMixpanelSink $value): self
    {
        $this->sink = $value;
        $this->_setField('sink');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStartFrom(): ?string
    {
        return $this->startFrom;
    }

    /**
     * @param ?string $value
     */
    public function setStartFrom(?string $value = null): self
    {
        $this->startFrom = $value;
        $this->_setField('startFrom');
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
