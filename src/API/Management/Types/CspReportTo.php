<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Report-To header configuration.
 */
class CspReportTo extends JsonSerializableType
{
    /**
     * @var ?string $group Reporting group identifier.
     */
    #[JsonProperty('group')]
    private ?string $group;

    /**
     * @var ?int $maxAge Maximum age in seconds for the Report-To header.
     */
    #[JsonProperty('max_age')]
    private ?int $maxAge;

    /**
     * @var ?array<CspReportToEndpoint> $endpoints
     */
    #[JsonProperty('endpoints'), ArrayType([CspReportToEndpoint::class])]
    private ?array $endpoints;

    /**
     * @param array{
     *   group?: ?string,
     *   maxAge?: ?int,
     *   endpoints?: ?array<CspReportToEndpoint>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->group = $values['group'] ?? null;
        $this->maxAge = $values['maxAge'] ?? null;
        $this->endpoints = $values['endpoints'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param ?string $value
     */
    public function setGroup(?string $value = null): self
    {
        $this->group = $value;
        $this->_setField('group');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getMaxAge(): ?int
    {
        return $this->maxAge;
    }

    /**
     * @param ?int $value
     */
    public function setMaxAge(?int $value = null): self
    {
        $this->maxAge = $value;
        $this->_setField('maxAge');
        return $this;
    }

    /**
     * @return ?array<CspReportToEndpoint>
     */
    public function getEndpoints(): ?array
    {
        return $this->endpoints;
    }

    /**
     * @param ?array<CspReportToEndpoint> $value
     */
    public function setEndpoints(?array $value = null): self
    {
        $this->endpoints = $value;
        $this->_setField('endpoints');
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
