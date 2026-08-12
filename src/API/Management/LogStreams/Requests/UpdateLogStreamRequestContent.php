<?php

namespace Auth0\SDK\API\Management\LogStreams\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\LogStreamStatusEnum;
use Auth0\SDK\API\Management\Types\LogStreamFilter;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\LogStreamPiiConfig;
use Auth0\SDK\API\Management\Types\LogStreamHttpSink;
use Auth0\SDK\API\Management\Types\LogStreamDatadogSink;
use Auth0\SDK\API\Management\Types\LogStreamSplunkSink;
use Auth0\SDK\API\Management\Types\LogStreamSumoSink;
use Auth0\SDK\API\Management\Types\LogStreamSegmentSink;
use Auth0\SDK\API\Management\Types\LogStreamMixpanelSinkPatch;
use Auth0\SDK\API\Management\Core\Types\Union;

class UpdateLogStreamRequestContent extends JsonSerializableType
{
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
     * @var (
     *    LogStreamHttpSink
     *   |LogStreamDatadogSink
     *   |LogStreamSplunkSink
     *   |LogStreamSumoSink
     *   |LogStreamSegmentSink
     *   |LogStreamMixpanelSinkPatch
     * )|null $sink
     */
    #[JsonProperty('sink'), Union(LogStreamHttpSink::class, LogStreamDatadogSink::class, LogStreamSplunkSink::class, LogStreamSumoSink::class, LogStreamSegmentSink::class, LogStreamMixpanelSinkPatch::class, 'null')]
    private LogStreamHttpSink|LogStreamDatadogSink|LogStreamSplunkSink|LogStreamSumoSink|LogStreamSegmentSink|LogStreamMixpanelSinkPatch|null $sink;

    /**
     * @param array{
     *   name?: ?string,
     *   status?: ?value-of<LogStreamStatusEnum>,
     *   isPriority?: ?bool,
     *   filters?: ?array<LogStreamFilter>,
     *   piiConfig?: ?LogStreamPiiConfig,
     *   sink?: (
     *    LogStreamHttpSink
     *   |LogStreamDatadogSink
     *   |LogStreamSplunkSink
     *   |LogStreamSumoSink
     *   |LogStreamSegmentSink
     *   |LogStreamMixpanelSinkPatch
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->isPriority = $values['isPriority'] ?? null;
        $this->filters = $values['filters'] ?? null;
        $this->piiConfig = $values['piiConfig'] ?? null;
        $this->sink = $values['sink'] ?? null;
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
     * @return (
     *    LogStreamHttpSink
     *   |LogStreamDatadogSink
     *   |LogStreamSplunkSink
     *   |LogStreamSumoSink
     *   |LogStreamSegmentSink
     *   |LogStreamMixpanelSinkPatch
     * )|null
     */
    public function getSink(): LogStreamHttpSink|LogStreamDatadogSink|LogStreamSplunkSink|LogStreamSumoSink|LogStreamSegmentSink|LogStreamMixpanelSinkPatch|null
    {
        return $this->sink;
    }

    /**
     * @param (
     *    LogStreamHttpSink
     *   |LogStreamDatadogSink
     *   |LogStreamSplunkSink
     *   |LogStreamSumoSink
     *   |LogStreamSegmentSink
     *   |LogStreamMixpanelSinkPatch
     * )|null $value
     */
    public function setSink(LogStreamHttpSink|LogStreamDatadogSink|LogStreamSplunkSink|LogStreamSumoSink|LogStreamSegmentSink|LogStreamMixpanelSinkPatch|null $value = null): self
    {
        $this->sink = $value;
        $this->_setField('sink');
        return $this;
    }
}
