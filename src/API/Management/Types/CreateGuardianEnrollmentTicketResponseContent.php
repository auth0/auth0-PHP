<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class CreateGuardianEnrollmentTicketResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $ticketId The ticket_id used to identify the enrollment
     */
    #[JsonProperty('ticket_id')]
    private ?string $ticketId;

    /**
     * @var ?string $ticketUrl The url you can use to start enrollment
     */
    #[JsonProperty('ticket_url')]
    private ?string $ticketUrl;

    /**
     * @param array{
     *   ticketId?: ?string,
     *   ticketUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ticketId = $values['ticketId'] ?? null;
        $this->ticketUrl = $values['ticketUrl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTicketId(): ?string
    {
        return $this->ticketId;
    }

    /**
     * @param ?string $value
     */
    public function setTicketId(?string $value = null): self
    {
        $this->ticketId = $value;
        $this->_setField('ticketId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTicketUrl(): ?string
    {
        return $this->ticketUrl;
    }

    /**
     * @param ?string $value
     */
    public function setTicketUrl(?string $value = null): self
    {
        $this->ticketUrl = $value;
        $this->_setField('ticketUrl');
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
