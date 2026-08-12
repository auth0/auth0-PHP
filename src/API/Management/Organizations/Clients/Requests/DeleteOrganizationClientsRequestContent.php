<?php

namespace Auth0\SDK\API\Management\Organizations\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class DeleteOrganizationClientsRequestContent extends JsonSerializableType
{
    /**
     * @var array<string> $clients List of client IDs to disassociate from the organization.
     */
    #[JsonProperty('clients'), ArrayType(['string'])]
    private array $clients;

    /**
     * @param array{
     *   clients: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clients = $values['clients'];
    }

    /**
     * @return array<string>
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param array<string> $value
     */
    public function setClients(array $value): self
    {
        $this->clients = $value;
        $this->_setField('clients');
        return $this;
    }
}
