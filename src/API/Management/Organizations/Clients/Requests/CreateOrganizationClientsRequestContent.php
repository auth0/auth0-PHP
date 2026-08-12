<?php

namespace Auth0\SDK\API\Management\Organizations\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\CreateOrganizationClientRequestItem;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateOrganizationClientsRequestContent extends JsonSerializableType
{
    /**
     * @var array<CreateOrganizationClientRequestItem> $clients List of clients to associate with the organization.
     */
    #[JsonProperty('clients'), ArrayType([CreateOrganizationClientRequestItem::class])]
    private array $clients;

    /**
     * @param array{
     *   clients: array<CreateOrganizationClientRequestItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clients = $values['clients'];
    }

    /**
     * @return array<CreateOrganizationClientRequestItem>
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param array<CreateOrganizationClientRequestItem> $value
     */
    public function setClients(array $value): self
    {
        $this->clients = $value;
        $this->_setField('clients');
        return $this;
    }
}
