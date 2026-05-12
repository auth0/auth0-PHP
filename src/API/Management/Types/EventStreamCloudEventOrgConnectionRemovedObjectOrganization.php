<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Information about an Auth0 Organization.
 */
class EventStreamCloudEventOrgConnectionRemovedObjectOrganization extends JsonSerializableType
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
     * @param array{
     *   id: string,
     *   name?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'] ?? null;
        $this->id = $values['id'];
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
