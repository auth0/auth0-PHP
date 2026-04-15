<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionJsonParseJsonParams extends JsonSerializableType
{
    /**
     * @var string $json
     */
    #[JsonProperty('json')]
    private string $json;

    /**
     * @param array{
     *   json: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->json = $values['json'];
    }

    /**
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }

    /**
     * @param string $value
     */
    public function setJson(string $value): self
    {
        $this->json = $value;
        $this->_setField('json');
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
