<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetUniversalLoginTemplate extends JsonSerializableType
{
    /**
     * @var ?string $body The custom page template for the New Universal Login Experience
     */
    #[JsonProperty('body')]
    private ?string $body;

    /**
     * @param array{
     *   body?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->body = $values['body'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param ?string $value
     */
    public function setBody(?string $value = null): self
    {
        $this->body = $value;
        $this->_setField('body');
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
