<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Controls whether organization admins may enable Cross App Access (XAA) on their Identity Providers.
 */
class ConnectionProfileCrossAppAccessResourceApp extends JsonSerializableType
{
    /**
     * @var ConnectionProfileCrossAppAccessResourceAppStatus $status
     */
    #[JsonProperty('status')]
    private ConnectionProfileCrossAppAccessResourceAppStatus $status;

    /**
     * @param array{
     *   status: ConnectionProfileCrossAppAccessResourceAppStatus,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->status = $values['status'];
    }

    /**
     * @return ConnectionProfileCrossAppAccessResourceAppStatus
     */
    public function getStatus(): ConnectionProfileCrossAppAccessResourceAppStatus
    {
        return $this->status;
    }

    /**
     * @param ConnectionProfileCrossAppAccessResourceAppStatus $value
     */
    public function setStatus(ConnectionProfileCrossAppAccessResourceAppStatus $value): self
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
