<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ClientRefreshTokenPolicy extends JsonSerializableType
{
    /**
     * @var string $audience The identifier of the resource server to which the Multi Resource Refresh Token Policy applies
     */
    #[JsonProperty('audience')]
    private string $audience;

    /**
     * @var array<string> $scope The resource server permissions granted under the Multi Resource Refresh Token Policy, defining the context in which an access token can be used
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    private array $scope;

    /**
     * @param array{
     *   audience: string,
     *   scope: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->audience = $values['audience'];
        $this->scope = $values['scope'];
    }

    /**
     * @return string
     */
    public function getAudience(): string
    {
        return $this->audience;
    }

    /**
     * @param string $value
     */
    public function setAudience(string $value): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getScope(): array
    {
        return $this->scope;
    }

    /**
     * @param array<string> $value
     */
    public function setScope(array $value): self
    {
        $this->scope = $value;
        $this->_setField('scope');
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
