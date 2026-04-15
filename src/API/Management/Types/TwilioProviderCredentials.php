<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class TwilioProviderCredentials extends JsonSerializableType
{
    /**
     * @var string $authToken
     */
    #[JsonProperty('auth_token')]
    private string $authToken;

    /**
     * @param array{
     *   authToken: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->authToken = $values['authToken'];
    }

    /**
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authToken;
    }

    /**
     * @param string $value
     */
    public function setAuthToken(string $value): self
    {
        $this->authToken = $value;
        $this->_setField('authToken');
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
