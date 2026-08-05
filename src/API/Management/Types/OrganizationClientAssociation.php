<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The organization's association with the client passed in the <code>include_client_association_for</code> query parameter.
 */
class OrganizationClientAssociation extends JsonSerializableType
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

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
