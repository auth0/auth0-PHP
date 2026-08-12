<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListUserAttributeProfileTemplateResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<UserAttributeProfileTemplateItem> $userAttributeProfileTemplates
     */
    #[JsonProperty('user_attribute_profile_templates'), ArrayType([UserAttributeProfileTemplateItem::class])]
    private ?array $userAttributeProfileTemplates;

    /**
     * @param array{
     *   userAttributeProfileTemplates?: ?array<UserAttributeProfileTemplateItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userAttributeProfileTemplates = $values['userAttributeProfileTemplates'] ?? null;
    }

    /**
     * @return ?array<UserAttributeProfileTemplateItem>
     */
    public function getUserAttributeProfileTemplates(): ?array
    {
        return $this->userAttributeProfileTemplates;
    }

    /**
     * @param ?array<UserAttributeProfileTemplateItem> $value
     */
    public function setUserAttributeProfileTemplates(?array $value = null): self
    {
        $this->userAttributeProfileTemplates = $value;
        $this->_setField('userAttributeProfileTemplates');
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
