<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Defines the default Organization ID and flows
 */
class ClientDefaultOrganization extends JsonSerializableType
{
    /**
     * @var string $organizationId The default Organization ID to be used
     */
    #[JsonProperty('organization_id')]
    private string $organizationId;

    /**
     * @var array<value-of<ClientDefaultOrganizationFlowsEnum>> $flows The default Organization usage
     */
    #[JsonProperty('flows'), ArrayType(['string'])]
    private array $flows;

    /**
     * @param array{
     *   organizationId: string,
     *   flows: array<value-of<ClientDefaultOrganizationFlowsEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organizationId = $values['organizationId'];
        $this->flows = $values['flows'];
    }

    /**
     * @return string
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * @param string $value
     */
    public function setOrganizationId(string $value): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
        return $this;
    }

    /**
     * @return array<value-of<ClientDefaultOrganizationFlowsEnum>>
     */
    public function getFlows(): array
    {
        return $this->flows;
    }

    /**
     * @param array<value-of<ClientDefaultOrganizationFlowsEnum>> $value
     */
    public function setFlows(array $value): self
    {
        $this->flows = $value;
        $this->_setField('flows');
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
