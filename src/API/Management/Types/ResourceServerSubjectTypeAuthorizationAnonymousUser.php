<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Access Permissions for anonymous user flows
 */
class ResourceServerSubjectTypeAuthorizationAnonymousUser extends JsonSerializableType
{
    /**
     * @var ?value-of<ResourceServerSubjectTypeAuthorizationAnonymousUserPolicyEnum> $policy
     */
    #[JsonProperty('policy')]
    private ?string $policy;

    /**
     * @param array{
     *   policy?: ?value-of<ResourceServerSubjectTypeAuthorizationAnonymousUserPolicyEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->policy = $values['policy'] ?? null;
    }

    /**
     * @return ?value-of<ResourceServerSubjectTypeAuthorizationAnonymousUserPolicyEnum>
     */
    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    /**
     * @param ?value-of<ResourceServerSubjectTypeAuthorizationAnonymousUserPolicyEnum> $value
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
