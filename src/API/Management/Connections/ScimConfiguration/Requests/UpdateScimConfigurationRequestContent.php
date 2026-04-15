<?php

namespace Auth0\SDK\API\Management\Connections\ScimConfiguration\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\ScimMappingItem;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class UpdateScimConfigurationRequestContent extends JsonSerializableType
{
    /**
     * @var string $userIdAttribute User ID attribute for generating unique user ids
     */
    #[JsonProperty('user_id_attribute')]
    private string $userIdAttribute;

    /**
     * @var array<ScimMappingItem> $mapping The mapping between auth0 and SCIM
     */
    #[JsonProperty('mapping'), ArrayType([ScimMappingItem::class])]
    private array $mapping;

    /**
     * @param array{
     *   userIdAttribute: string,
     *   mapping: array<ScimMappingItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userIdAttribute = $values['userIdAttribute'];
        $this->mapping = $values['mapping'];
    }

    /**
     * @return string
     */
    public function getUserIdAttribute(): string
    {
        return $this->userIdAttribute;
    }

    /**
     * @param string $value
     */
    public function setUserIdAttribute(string $value): self
    {
        $this->userIdAttribute = $value;
        $this->_setField('userIdAttribute');
        return $this;
    }

    /**
     * @return array<ScimMappingItem>
     */
    public function getMapping(): array
    {
        return $this->mapping;
    }

    /**
     * @param array<ScimMappingItem> $value
     */
    public function setMapping(array $value): self
    {
        $this->mapping = $value;
        $this->_setField('mapping');
        return $this;
    }
}
