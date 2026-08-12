<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListConnectionProfileTemplateResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<ConnectionProfileTemplateItem> $connectionProfileTemplates
     */
    #[JsonProperty('connection_profile_templates'), ArrayType([ConnectionProfileTemplateItem::class])]
    private ?array $connectionProfileTemplates;

    /**
     * @param array{
     *   connectionProfileTemplates?: ?array<ConnectionProfileTemplateItem>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->connectionProfileTemplates = $values['connectionProfileTemplates'] ?? null;
    }

    /**
     * @return ?array<ConnectionProfileTemplateItem>
     */
    public function getConnectionProfileTemplates(): ?array
    {
        return $this->connectionProfileTemplates;
    }

    /**
     * @param ?array<ConnectionProfileTemplateItem> $value
     */
    public function setConnectionProfileTemplates(?array $value = null): self
    {
        $this->connectionProfileTemplates = $value;
        $this->_setField('connectionProfileTemplates');
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
