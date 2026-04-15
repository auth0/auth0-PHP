<?php

namespace Auth0\SDK\API\Management\RulesConfigs\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetRulesConfigRequestContent extends JsonSerializableType
{
    /**
     * @var string $value Value for a rules config variable.
     */
    #[JsonProperty('value')]
    private string $value;

    /**
     * @param array{
     *   value: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->value = $values['value'];
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        $this->_setField('value');
        return $this;
    }
}
