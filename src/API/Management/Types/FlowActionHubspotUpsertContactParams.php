<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionHubspotUpsertContactParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    private string $email;

    /**
     * @var ?array<FlowActionHubspotUpsertContactParamsProperty> $properties
     */
    #[JsonProperty('properties'), ArrayType([FlowActionHubspotUpsertContactParamsProperty::class])]
    private ?array $properties;

    /**
     * @param array{
     *   connectionId: string,
     *   email: string,
     *   properties?: ?array<FlowActionHubspotUpsertContactParamsProperty>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->email = $values['email'];
        $this->properties = $values['properties'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?array<FlowActionHubspotUpsertContactParamsProperty>
     */
    public function getProperties(): ?array
    {
        return $this->properties;
    }

    /**
     * @param ?array<FlowActionHubspotUpsertContactParamsProperty> $value
     */
    public function setProperties(?array $value = null): self
    {
        $this->properties = $value;
        $this->_setField('properties');
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
