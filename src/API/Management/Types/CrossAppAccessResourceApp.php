<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Cross App Access - Resource App settings that apply to this connection.
 */
class CrossAppAccessResourceApp extends JsonSerializableType
{
    /**
     * @var value-of<CrossAppAccessResourceAppStatusEnum> $status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @param array{
     *   status: value-of<CrossAppAccessResourceAppStatusEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return value-of<CrossAppAccessResourceAppStatusEnum>
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param value-of<CrossAppAccessResourceAppStatusEnum> $value
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
