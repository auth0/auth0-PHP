<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * X-XSS-Protection header configuration (deprecated header, use CSP instead).
 */
class XssProtectionConfig extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether X-XSS-Protection header is enabled.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?value-of<XssProtectionMode> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @var ?string $reportUri HTTPS endpoint for X-XSS-Protection violation reports.
     */
    #[JsonProperty('report_uri')]
    private ?string $reportUri;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   mode?: ?value-of<XssProtectionMode>,
     *   reportUri?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->mode = $values['mode'] ?? null;
        $this->reportUri = $values['reportUri'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * @param ?bool $value
     */
    public function setEnabled(?bool $value = null): self
    {
        $this->enabled = $value;
        $this->_setField('enabled');
        return $this;
    }

    /**
     * @return ?value-of<XssProtectionMode>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<XssProtectionMode> $value
     */
    public function setMode(?string $value = null): self
    {
        $this->mode = $value;
        $this->_setField('mode');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getReportUri(): ?string
    {
        return $this->reportUri;
    }

    /**
     * @param ?string $value
     */
    public function setReportUri(?string $value = null): self
    {
        $this->reportUri = $value;
        $this->_setField('reportUri');
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
