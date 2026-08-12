<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Access Permissions for user flows
 */
class ResourceServerSubjectTypeAuthorizationUser extends JsonSerializableType
{
    /**
     * @var ?value-of<ResourceServerSubjectTypeAuthorizationUserPolicyEnum> $policy
     */
    #[JsonProperty('policy')]
    private ?string $policy;

    /**
     * @param array{
     *   policy?: ?value-of<ResourceServerSubjectTypeAuthorizationUserPolicyEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->policy = $values['policy'] ?? null;
    }

    /**
     * @return ?value-of<ResourceServerSubjectTypeAuthorizationUserPolicyEnum>
     */
    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    /**
     * @param ?value-of<ResourceServerSubjectTypeAuthorizationUserPolicyEnum> $value
     */
    public function setPolicy(?string $value = null): self
    {
        $this->policy = $value;
        $this->_setField('policy');
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
