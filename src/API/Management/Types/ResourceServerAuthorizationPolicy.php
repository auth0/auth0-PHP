<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Authorization policy for the resource server.
 */
class ResourceServerAuthorizationPolicy extends JsonSerializableType
{
    /**
     * @var string $policyId The ID of the authorization policy to apply.
     */
    #[JsonProperty('policy_id')]
    private string $policyId;

    /**
     * @param array{
     *   policyId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->policyId = $values['policyId'];
    }

    /**
     * @return string
     */
    public function getPolicyId(): string
    {
        return $this->policyId;
    }

    /**
     * @param string $value
     */
    public function setPolicyId(string $value): self
    {
        $this->policyId = $value;
        $this->_setField('policyId');
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
