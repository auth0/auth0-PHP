<?php

namespace Auth0\SDK\API\Management\Organizations\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateOrganizationClientRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $useForMemberAccess Whether this client is used for member access to the organization.
     */
    #[JsonProperty('use_for_member_access')]
    private ?bool $useForMemberAccess;

    /**
     * @param array{
     *   useForMemberAccess?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->useForMemberAccess = $values['useForMemberAccess'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getUseForMemberAccess(): ?bool
    {
        return $this->useForMemberAccess;
    }

    /**
     * @param ?bool $value
     */
    public function setUseForMemberAccess(?bool $value = null): self
    {
        $this->useForMemberAccess = $value;
        $this->_setField('useForMemberAccess');
        return $this;
    }
}
