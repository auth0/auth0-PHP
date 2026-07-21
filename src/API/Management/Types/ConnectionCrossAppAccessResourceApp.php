<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Cross App Access - Resource App settings that apply to this connection.
 */
class ConnectionCrossAppAccessResourceApp extends JsonSerializableType
{
    /**
     * @var value-of<ConnectionCrossAppAccessResourceAppStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @param array{
     *   status: value-of<ConnectionCrossAppAccessResourceAppStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return value-of<ConnectionCrossAppAccessResourceAppStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<ConnectionCrossAppAccessResourceAppStatusEnum> $value
     */
    public function setStatus(string $value): self
    {
        $this->status = $value;
        $this->_setField('status');
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
