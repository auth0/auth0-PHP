<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * The identity of the delegating party/session actor for delegated sessions. Present only on delegated sessions. Contains "sub" and up to 5 additional primitive claims.
 */
class SessionActorMetadata extends JsonSerializableType
{
    /**
     * @var string $sub Subject identifier of the actor
     */
    #[JsonProperty('sub')]
    private string $sub;

    /**
     * @param array{
     *   sub: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->sub = $values['sub'];
    }

    /**
     * @return string
     */
    public function getSub(): string
    {
        return $this->sub;
    }

    /**
     * @param string $value
     */
    public function setSub(string $value): self
    {
        $this->sub = $value;
        $this->_setField('sub');
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
