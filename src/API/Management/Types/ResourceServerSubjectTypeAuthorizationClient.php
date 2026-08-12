<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Access Permissions for client flows
 */
class ResourceServerSubjectTypeAuthorizationClient extends JsonSerializableType
{
    /**
     * @var ?value-of<ResourceServerSubjectTypeAuthorizationClientPolicyEnum> $policy
     */
    #[JsonProperty('policy')]
    private ?string $policy;

    /**
     * @param array{
     *   policy?: ?value-of<ResourceServerSubjectTypeAuthorizationClientPolicyEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->policy = $values['policy'] ?? null;
    }

    /**
     * @return ?value-of<ResourceServerSubjectTypeAuthorizationClientPolicyEnum>
     */
    public function getPolicy(): ?string
    {
        return $this->policy;
    }

    /**
     * @param ?value-of<ResourceServerSubjectTypeAuthorizationClientPolicyEnum> $value
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
