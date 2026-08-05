<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateOrganizationClientRequestItem extends JsonSerializableType
{
    /**
     * @var string $clientId The identifier of the client to associate.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var bool $useForMemberAccess Whether this client is used for member access to the organization.
     */
    #[JsonProperty('use_for_member_access')]
    private bool $useForMemberAccess;

    /**
     * @param array{
     *   clientId: string,
     *   useForMemberAccess: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientId = $values['clientId'];
        $this->useForMemberAccess = $values['useForMemberAccess'];
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
