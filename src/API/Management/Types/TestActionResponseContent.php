<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class TestActionResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $payload
     */
    #[JsonProperty('payload'), ArrayType(['string' => 'mixed'])]
    private ?array $payload;

    /**
     * @param array{
     *   payload?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->payload = $values['payload'] ?? null;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setPayload(?array $value = null): self
    {
        $this->payload = $value;
        $this->_setField('payload');
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
