<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Mapping of claims received from the identity provider (IdP)
 */
class EventStreamCloudEventConnectionCreatedPreviousObject1OptionsAttributeMap extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $attributes
     */
    #[JsonProperty('attributes'), ArrayType(['string' => 'mixed'])]
    private ?array $attributes;

    /**
     * @var ?string $userinfoScope Scopes to send to the IdP's Userinfo endpoint
     */
    #[JsonProperty('userinfo_scope')]
    private ?string $userinfoScope;

    /**
     * @var ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject1OptionsAttributeMapMappingModeEnum> $mappingMode
     */
    #[JsonProperty('mapping_mode')]
    private ?string $mappingMode;

    /**
     * @param array{
     *   attributes?: ?array<string, mixed>,
     *   userinfoScope?: ?string,
     *   mappingMode?: ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject1OptionsAttributeMapMappingModeEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->attributes = $values['attributes'] ?? null;
        $this->userinfoScope = $values['userinfoScope'] ?? null;
        $this->mappingMode = $values['mappingMode'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setAttributes(?array $value = null): self
    {
        $this->attributes = $value;
        $this->_setField('attributes');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserinfoScope(): ?string
    {
        return $this->userinfoScope;
    }

    /**
     * @param ?string $value
     */
    public function setUserinfoScope(?string $value = null): self
    {
        $this->userinfoScope = $value;
        $this->_setField('userinfoScope');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject1OptionsAttributeMapMappingModeEnum>
     */
    public function getMappingMode(): ?string
    {
        return $this->mappingMode;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionCreatedPreviousObject1OptionsAttributeMapMappingModeEnum> $value
     */
    public function setMappingMode(?string $value = null): self
    {
        $this->mappingMode = $value;
        $this->_setField('mappingMode');
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
