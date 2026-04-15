<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamDatadogSink extends JsonSerializableType
{
    /**
     * @var string $datadogApiKey Datadog API Key
     */
    #[JsonProperty('datadogApiKey')]
    private string $datadogApiKey;

    /**
     * @var value-of<LogStreamDatadogRegionEnum> $datadogRegion
     */
    #[JsonProperty('datadogRegion')]
    private string $datadogRegion;

    /**
     * @param array{
     *   datadogApiKey: string,
     *   datadogRegion: value-of<LogStreamDatadogRegionEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->datadogApiKey = $values['datadogApiKey'];
        $this->datadogRegion = $values['datadogRegion'];
    }

    /**
     * @return string
     */
    public function getDatadogApiKey(): string
    {
        return $this->datadogApiKey;
    }

    /**
     * @param string $value
     */
    public function setDatadogApiKey(string $value): self
    {
        $this->datadogApiKey = $value;
        $this->_setField('datadogApiKey');
        return $this;
    }

    /**
     * @return value-of<LogStreamDatadogRegionEnum>
     */
    public function getDatadogRegion(): string
    {
        return $this->datadogRegion;
    }

    /**
     * @param value-of<LogStreamDatadogRegionEnum> $value
     */
    public function setDatadogRegion(string $value): self
    {
        $this->datadogRegion = $value;
        $this->_setField('datadogRegion');
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
