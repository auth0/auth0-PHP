<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * The event content.
 */
class EventStreamCloudEventOrgUpdatedObject extends JsonSerializableType
{
    /**
     * @var ?string $name The human-readable identifier for the organization that will be used by end-users to direct them to their organization in your application..
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var string $id ID of the organization.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $displayName If set, the name that will be displayed to end-users for this organization in any interaction with them.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?array<string, mixed> $metadata
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $metadata;

    /**
     * @var ?EventStreamCloudEventOrgUpdatedObjectBranding $branding
     */
    #[JsonProperty('branding')]
    private ?EventStreamCloudEventOrgUpdatedObjectBranding $branding;

    /**
     * @param array{
     *   id: string,
     *   name?: ?string,
     *   displayName?: ?string,
     *   metadata?: ?array<string, mixed>,
     *   branding?: ?EventStreamCloudEventOrgUpdatedObjectBranding,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'] ?? null;
        $this->id = $values['id'];
        $this->displayName = $values['displayName'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->branding = $values['branding'] ?? null;
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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setMetadata(?array $value = null): self
    {
        $this->metadata = $value;
        $this->_setField('metadata');
        return $this;
    }

    /**
     * @return ?EventStreamCloudEventOrgUpdatedObjectBranding
     */
    public function getBranding(): ?EventStreamCloudEventOrgUpdatedObjectBranding
    {
        return $this->branding;
    }

    /**
     * @param ?EventStreamCloudEventOrgUpdatedObjectBranding $value
     */
    public function setBranding(?EventStreamCloudEventOrgUpdatedObjectBranding $value = null): self
    {
        $this->branding = $value;
        $this->_setField('branding');
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
