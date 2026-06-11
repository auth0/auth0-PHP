<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * A single CSP policy with mode, directives, flags, and optional reporting.
 */
class CspPolicy extends JsonSerializableType
{
    /**
     * @var ?value-of<CspPolicyMode> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @var ?array<string, array<string>> $directives
     */
    #[JsonProperty('directives'), ArrayType(['string' => ['string']])]
    private ?array $directives;

    /**
     * @var ?array<value-of<CspFlag>> $flags
     */
    #[JsonProperty('flags'), ArrayType(['string'])]
    private ?array $flags;

    /**
     * @var ?CspPolicyReporting $reporting
     */
    #[JsonProperty('reporting')]
    private ?CspPolicyReporting $reporting;

    /**
     * @param array{
     *   mode?: ?value-of<CspPolicyMode>,
     *   directives?: ?array<string, array<string>>,
     *   flags?: ?array<value-of<CspFlag>>,
     *   reporting?: ?CspPolicyReporting,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mode = $values['mode'] ?? null;
        $this->directives = $values['directives'] ?? null;
        $this->flags = $values['flags'] ?? null;
        $this->reporting = $values['reporting'] ?? null;
    }

    /**
     * @return ?value-of<CspPolicyMode>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<CspPolicyMode> $value
     */
    public function setMode(?string $value = null): self
    {
        $this->mode = $value;
        $this->_setField('mode');
        return $this;
    }

    /**
     * @return ?array<string, array<string>>
     */
    public function getDirectives(): ?array
    {
        return $this->directives;
    }

    /**
     * @param ?array<string, array<string>> $value
     */
    public function setDirectives(?array $value = null): self
    {
        $this->directives = $value;
        $this->_setField('directives');
        return $this;
    }

    /**
     * @return ?array<value-of<CspFlag>>
     */
    public function getFlags(): ?array
    {
        return $this->flags;
    }

    /**
     * @param ?array<value-of<CspFlag>> $value
     */
    public function setFlags(?array $value = null): self
    {
        $this->flags = $value;
        $this->_setField('flags');
        return $this;
    }

    /**
     * @return ?CspPolicyReporting
     */
    public function getReporting(): ?CspPolicyReporting
    {
        return $this->reporting;
    }

    /**
     * @param ?CspPolicyReporting $value
     */
    public function setReporting(?CspPolicyReporting $value = null): self
    {
        $this->reporting = $value;
        $this->_setField('reporting');
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
