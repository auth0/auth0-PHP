<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateDirectorySynchronizationResponseContent extends JsonSerializableType
{
    /**
     * @var string $connectionId The connection's identifier
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $synchronizationId The synchronization's identifier
     */
    #[JsonProperty('synchronization_id')]
    private string $synchronizationId;

    /**
     * @var string $status The synchronization status
     */
    #[JsonProperty('status')]
    private string $status;

    /**
     * @param array{
     *   connectionId: string,
     *   synchronizationId: string,
     *   status: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->synchronizationId = $values['synchronizationId'];
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return string
     */
    public function getSynchronizationId(): string
    {
        return $this->synchronizationId;
    }

    /**
     * @param string $value
     */
    public function setSynchronizationId(string $value): self
    {
        $this->synchronizationId = $value;
        $this->_setField('synchronizationId');
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $value
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
