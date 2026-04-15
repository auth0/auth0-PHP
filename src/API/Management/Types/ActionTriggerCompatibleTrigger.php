<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ActionTriggerCompatibleTrigger extends JsonSerializableType
{
    /**
     * @var value-of<ActionTriggerTypeEnum> $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $version The version of a trigger. v1, v2, etc.
     */
    #[JsonProperty('version')]
    private string $version;

    /**
     * @param array{
     *   id: value-of<ActionTriggerTypeEnum>,
     *   version: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->version = $values['version'];
    }

    /**
     * @return value-of<ActionTriggerTypeEnum>
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param value-of<ActionTriggerTypeEnum> $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $value
     */
    public function setVersion(string $value): self
    {
        $this->version = $value;
        $this->_setField('version');
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
