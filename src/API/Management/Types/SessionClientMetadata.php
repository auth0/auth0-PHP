<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Client details
 */
class SessionClientMetadata extends JsonSerializableType
{
    /**
     * @var ?string $clientId ID of client for the session
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @param array{
     *   clientId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
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
