<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserBlocksResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<UserBlockIdentifier> $blockedFor Array of identifier + IP address pairs.  IP address is optional, and may be omitted in certain circumstances (such as Account Lockout mode).
     */
    #[JsonProperty('blocked_for'), ArrayType([UserBlockIdentifier::class])]
    private ?array $blockedFor;

    /**
     * @param array{
     *   blockedFor?: ?array<UserBlockIdentifier>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->blockedFor = $values['blockedFor'] ?? null;
    }

    /**
     * @return ?array<UserBlockIdentifier>
     */
    public function getBlockedFor(): ?array
    {
        return $this->blockedFor;
    }

    /**
     * @param ?array<UserBlockIdentifier> $value
     */
    public function setBlockedFor(?array $value = null): self
    {
        $this->blockedFor = $value;
        $this->_setField('blockedFor');
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
