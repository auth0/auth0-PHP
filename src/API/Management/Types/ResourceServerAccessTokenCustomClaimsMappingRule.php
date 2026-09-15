<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ResourceServerAccessTokenCustomClaimsMappingRule extends JsonSerializableType
{
    /**
     * @var string $name The access-token claim name to emit, stored with the casing you provide. Reserved OIDC/JWT claim names are not allowed (compared case-insensitively).
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $expression Restricted dot-path expression read from the anonymous-session context (e.g. `anonymous_session.metadata.country`).
     */
    #[JsonProperty('expression')]
    private string $expression;

    /**
     * @param array{
     *   name: string,
     *   expression: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->expression = $values['expression'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return string
     */
    public function getExpression(): string
    {
        return $this->expression;
    }

    /**
     * @param string $value
     */
    public function setExpression(string $value): self
    {
        $this->expression = $value;
        $this->_setField('expression');
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
