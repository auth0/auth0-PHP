<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateSelfServiceProfileSsoTicketResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $ticket The URL for the created ticket.
     */
    #[JsonProperty('ticket')]
    private ?string $ticket;

    /**
     * @param array{
     *   ticket?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ticket = $values['ticket'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTicket(): ?string
    {
        return $this->ticket;
    }

    /**
     * @param ?string $value
     */
    public function setTicket(?string $value = null): self
    {
        $this->ticket = $value;
        $this->_setField('ticket');
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
