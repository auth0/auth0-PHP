<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamSplunkSink extends JsonSerializableType
{
    /**
     * @var string $splunkDomain Splunk URL Endpoint
     */
    #[JsonProperty('splunkDomain')]
    private string $splunkDomain;

    /**
     * @var string $splunkPort Port
     */
    #[JsonProperty('splunkPort')]
    private string $splunkPort;

    /**
     * @var string $splunkToken Splunk token
     */
    #[JsonProperty('splunkToken')]
    private string $splunkToken;

    /**
     * @var bool $splunkSecure Verify TLS certificate
     */
    #[JsonProperty('splunkSecure')]
    private bool $splunkSecure;

    /**
     * @param array{
     *   splunkDomain: string,
     *   splunkPort: string,
     *   splunkToken: string,
     *   splunkSecure: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->splunkDomain = $values['splunkDomain'];
        $this->splunkPort = $values['splunkPort'];
        $this->splunkToken = $values['splunkToken'];
        $this->splunkSecure = $values['splunkSecure'];
    }

    /**
     * @return string
     */
    public function getSplunkDomain(): string
    {
        return $this->splunkDomain;
    }

    /**
     * @param string $value
     */
    public function setSplunkDomain(string $value): self
    {
        $this->splunkDomain = $value;
        $this->_setField('splunkDomain');
        return $this;
    }

    /**
     * @return string
     */
    public function getSplunkPort(): string
    {
        return $this->splunkPort;
    }

    /**
     * @param string $value
     */
    public function setSplunkPort(string $value): self
    {
        $this->splunkPort = $value;
        $this->_setField('splunkPort');
        return $this;
    }

    /**
     * @return string
     */
    public function getSplunkToken(): string
    {
        return $this->splunkToken;
    }

    /**
     * @param string $value
     */
    public function setSplunkToken(string $value): self
    {
        $this->splunkToken = $value;
        $this->_setField('splunkToken');
        return $this;
    }

    /**
     * @return bool
     */
    public function getSplunkSecure(): bool
    {
        return $this->splunkSecure;
    }

    /**
     * @param bool $value
     */
    public function setSplunkSecure(bool $value): self
    {
        $this->splunkSecure = $value;
        $this->_setField('splunkSecure');
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
