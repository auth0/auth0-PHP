<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionXmlParseXmlParams extends JsonSerializableType
{
    /**
     * @var string $xml
     */
    #[JsonProperty('xml')]
    private string $xml;

    /**
     * @param array{
     *   xml: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->xml = $values['xml'];
    }

    /**
     * @return string
     */
    public function getXml(): string
    {
        return $this->xml;
    }

    /**
     * @param string $value
     */
    public function setXml(string $value): self
    {
        $this->xml = $value;
        $this->_setField('xml');
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
