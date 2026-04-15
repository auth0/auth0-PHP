<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateScimConfigurationRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $userIdAttribute User ID attribute for generating unique user ids
     */
    #[JsonProperty('user_id_attribute')]
    private ?string $userIdAttribute;

    /**
     * @var ?array<ScimMappingItem> $mapping The mapping between auth0 and SCIM
     */
    #[JsonProperty('mapping'), ArrayType([ScimMappingItem::class])]
    private ?array $mapping;

    /**
     * @param array{
     *   userIdAttribute?: ?string,
     *   mapping?: ?array<ScimMappingItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userIdAttribute = $values['userIdAttribute'] ?? null;
        $this->mapping = $values['mapping'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getUserIdAttribute(): ?string
    {
        return $this->userIdAttribute;
    }

    /**
     * @param ?string $value
     */
    public function setUserIdAttribute(?string $value = null): self
    {
        $this->userIdAttribute = $value;
        $this->_setField('userIdAttribute');
        return $this;
    }

    /**
     * @return ?array<ScimMappingItem>
     */
    public function getMapping(): ?array
    {
        return $this->mapping;
    }

    /**
     * @param ?array<ScimMappingItem> $value
     */
    public function setMapping(?array $value = null): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
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
