<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserAttributeProfilesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next A cursor to be used as the "from" query parameter for the next page of results.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<UserAttributeProfile> $userAttributeProfiles
     */
    #[JsonProperty('user_attribute_profiles'), ArrayType([UserAttributeProfile::class])]
    private ?array $userAttributeProfiles;

    /**
     * @param array{
     *   next?: ?string,
     *   userAttributeProfiles?: ?array<UserAttributeProfile>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->userAttributeProfiles = $values['userAttributeProfiles'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
        return $this;
    }

    /**
     * @return ?array<UserAttributeProfile>
     */
    public function getUserAttributeProfiles(): ?array
    {
        return $this->userAttributeProfiles;
    }

    /**
     * @param ?array<UserAttributeProfile> $value
     */
    public function setUserAttributeProfiles(?array $value = null): self
    {
        $this->userAttributeProfiles = $value;
        $this->_setField('userAttributeProfiles');
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
