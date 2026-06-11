<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Content Security Policy configuration with multi-policy support.
 */
class ContentSecurityPolicyConfig extends JsonSerializableType
{
    /**
     * @var ?bool $enabled Whether CSP is enabled.
     */
    #[JsonProperty('enabled')]
    private ?bool $enabled;

    /**
     * @var ?array<CspPolicy> $policies
     */
    #[JsonProperty('policies'), ArrayType([CspPolicy::class])]
    private ?array $policies;

    /**
     * @var ?CspReportingInfrastructure $reportingInfrastructure
     */
    #[JsonProperty('reporting_infrastructure')]
    private ?CspReportingInfrastructure $reportingInfrastructure;

    /**
     * @param array{
     *   enabled?: ?bool,
     *   policies?: ?array<CspPolicy>,
     *   reportingInfrastructure?: ?CspReportingInfrastructure,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enabled = $values['enabled'] ?? null;
        $this->policies = $values['policies'] ?? null;
        $this->reportingInfrastructure = $values['reportingInfrastructure'] ?? null;
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
     * @return ?array<CspPolicy>
     */
    public function getPolicies(): ?array
    {
        return $this->policies;
    }

    /**
     * @param ?array<CspPolicy> $value
     */
    public function setPolicies(?array $value = null): self
    {
        $this->policies = $value;
        $this->_setField('policies');
        return $this;
    }

    /**
     * @return ?CspReportingInfrastructure
     */
    public function getReportingInfrastructure(): ?CspReportingInfrastructure
    {
        return $this->reportingInfrastructure;
    }

    /**
     * @param ?CspReportingInfrastructure $value
     */
    public function setReportingInfrastructure(?CspReportingInfrastructure $value = null): self
    {
        $this->reportingInfrastructure = $value;
        $this->_setField('reportingInfrastructure');
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
