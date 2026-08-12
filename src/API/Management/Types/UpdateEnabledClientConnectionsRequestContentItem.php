<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateEnabledClientConnectionsRequestContentItem extends JsonSerializableType
{
    /**
     * @var string $clientId The client_id of the client whose status will be changed. Note that the limit per PATCH request is 50 clients.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

    /**
     * @var bool $status Whether the connection is enabled or not for this client_id
     */
    #[JsonProperty('status')]
    private bool $status;

    /**
     * @param array{
     *   clientId: string,
     *   status: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientId = $values['clientId'];
        $this->status = $values['status'];
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $value
     */
    public function setClientId(string $value): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $value
     */
    public function setStatus(bool $value): self
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
