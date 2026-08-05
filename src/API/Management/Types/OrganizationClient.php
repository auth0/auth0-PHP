<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class OrganizationClient extends JsonSerializableType
{
    /**
     * @var string $clientId The identifier of the client associated with the organization.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var bool $useForMemberAccess Whether this client is used for member access to the organization.
     */
    #[JsonProperty('use_for_member_access')]
    private bool $useForMemberAccess;

    /**
     * @var OrganizationClientMetadata $client
     */
    #[JsonProperty('client')]
    private OrganizationClientMetadata $client;

    /**
     * @param array{
     *   clientId: string,
     *   useForMemberAccess: bool,
     *   client: OrganizationClientMetadata,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientId = $values['clientId'];
        $this->useForMemberAccess = $values['useForMemberAccess'];
        $this->client = $values['client'];
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $value
     */
    public function setClientId(string $value): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return bool
     */
    public function getUseForMemberAccess(): bool
    {
        return $this->useForMemberAccess;
    }

    /**
     * @param bool $value
     */
    public function setUseForMemberAccess(bool $value): self
    {
        $this->useForMemberAccess = $value;
        $this->_setField('useForMemberAccess');
        return $this;
    }

    /**
     * @return OrganizationClientMetadata
     */
    public function getClient(): OrganizationClientMetadata
    {
        return $this->client;
    }

    /**
     * @param OrganizationClientMetadata $value
     */
    public function setClient(OrganizationClientMetadata $value): self
    {
        $this->client = $value;
        $this->_setField('client');
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
