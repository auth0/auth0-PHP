<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Global reporting infrastructure configuration.
 */
class CspReportingInfrastructure extends JsonSerializableType
{
    /**
     * @var ?CspReportTo $reportTo
     */
    #[JsonProperty('report_to')]
    private ?CspReportTo $reportTo;

    /**
     * @var ?array<string, string> $reportingEndpoints
     */
    #[JsonProperty('reporting_endpoints'), ArrayType(['string' => 'string'])]
    private ?array $reportingEndpoints;

    /**
     * @param array{
     *   reportTo?: ?CspReportTo,
     *   reportingEndpoints?: ?array<string, string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->reportTo = $values['reportTo'] ?? null;
        $this->reportingEndpoints = $values['reportingEndpoints'] ?? null;
    }

    /**
     * @return ?CspReportTo
     */
    public function getReportTo(): ?CspReportTo
    {
        return $this->reportTo;
    }

    /**
     * @param ?CspReportTo $value
     */
    public function setReportTo(?CspReportTo $value = null): self
    {
        $this->reportTo = $value;
        $this->_setField('reportTo');
        return $this;
    }

    /**
     * @return ?array<string, string>
     */
    public function getReportingEndpoints(): ?array
    {
        return $this->reportingEndpoints;
    }

    /**
     * @param ?array<string, string> $value
     */
    public function setReportingEndpoints(?array $value = null): self
    {
        $this->reportingEndpoints = $value;
        $this->_setField('reportingEndpoints');
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
