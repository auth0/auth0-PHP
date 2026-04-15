<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class FlowActionFlowReturnJsonParams extends JsonSerializableType
{
    /**
     * @var (
     *    array<string, mixed>
     *   |string
     * ) $payload
     */
    #[JsonProperty('payload'), Union(['string' => 'mixed'], 'string')]
    private array|string $payload;

    /**
     * @param array{
     *   payload: (
     *    array<string, mixed>
     *   |string
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->payload = $values['payload'];
    }

    /**
     * @return (
     *    array<string, mixed>
     *   |string
     * )
     */
    public function getPayload(): array|string
    {
        return $this->payload;
    }

    /**
     * @param (
     *    array<string, mixed>
     *   |string
     * ) $value
     */
    public function setPayload(array|string $value): self
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
