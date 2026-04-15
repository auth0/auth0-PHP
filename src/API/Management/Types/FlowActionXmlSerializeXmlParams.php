<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionXmlSerializeXmlParams extends JsonSerializableType
{
    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * ) $object
     */
    #[JsonProperty('object'), Union('string', ['string' => 'mixed'])]
    private string|array $object;

    /**
     * @param array{
     *   object: (
     *    string
     *   |array<string, mixed>
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->object = $values['object'];
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )
     */
    public function getObject(): string|array
    {
        return $this->object;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * ) $value
     */
    public function setObject(string|array $value): self
    {
        $this->object = $value;
        $this->_setField('object');
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
