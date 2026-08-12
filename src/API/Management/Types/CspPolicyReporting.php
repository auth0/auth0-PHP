<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Per-policy reporting configuration.
 */
class CspPolicyReporting extends JsonSerializableType
{
    /**
     * @var ?string $reportUri HTTPS endpoint for CSP violation reports.
     */
    #[JsonProperty('report_uri')]
    private ?string $reportUri;

    /**
     * @var ?string $reportToGroup Report-To group name for modern reporting.
     */
    #[JsonProperty('report_to_group')]
    private ?string $reportToGroup;

    /**
     * @param array{
     *   reportUri?: ?string,
     *   reportToGroup?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->reportUri = $values['reportUri'] ?? null;
        $this->reportToGroup = $values['reportToGroup'] ?? null;
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
     * @return ?string
     */
    public function getReportToGroup(): ?string
    {
        return $this->reportToGroup;
    }

    /**
     * @param ?string $value
     */
    public function setReportToGroup(?string $value = null): self
    {
        $this->reportToGroup = $value;
        $this->_setField('reportToGroup');
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
