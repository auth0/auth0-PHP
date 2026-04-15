<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionJwtDecodeJwtParams extends JsonSerializableType
{
    /**
     * @var string $token
     */
    #[JsonProperty('token')]
    private string $token;

    /**
     * @param array{
     *   token: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->token = $values['token'];
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $value
     */
    public function setToken(string $value): self
    {
        $this->token = $value;
        $this->_setField('token');
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
