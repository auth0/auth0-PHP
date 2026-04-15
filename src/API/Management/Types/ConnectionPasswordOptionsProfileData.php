<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Personal information restriction policy to prevent use of profile data in passwords
 */
class ConnectionPasswordOptionsProfileData extends JsonSerializableType
{
    /**
     * @var ?bool $active Prevents users from including profile data (like name, email) in their passwords
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?array<string> $blockedFields Blocked profile fields. An array of up to 12 entries.
     */
    #[JsonProperty('blocked_fields'), ArrayType(['string'])]
    private ?array $blockedFields;

    /**
     * @param array{
     *   active?: ?bool,
     *   blockedFields?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->blockedFields = $values['blockedFields'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getBlockedFields(): ?array
    {
        return $this->blockedFields;
    }

    /**
     * @param ?array<string> $value
     */
    public function setBlockedFields(?array $value = null): self
    {
        $this->blockedFields = $value;
        $this->_setField('blockedFields');
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
