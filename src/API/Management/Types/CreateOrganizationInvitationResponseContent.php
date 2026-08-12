<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateOrganizationInvitationResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The id of the user invitation.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $organizationId Organization identifier.
     */
    #[JsonProperty('organization_id')]
    private ?string $organizationId;

    /**
     * @var ?OrganizationInvitationInviter $inviter
     */
    #[JsonProperty('inviter')]
    private ?OrganizationInvitationInviter $inviter;

    /**
     * @var ?OrganizationInvitationInvitee $invitee
     */
    #[JsonProperty('invitee')]
    private ?OrganizationInvitationInvitee $invitee;

    /**
     * @var ?string $invitationUrl The invitation url to be send to the invitee.
     */
    #[JsonProperty('invitation_url')]
    private ?string $invitationUrl;

    /**
     * @var ?DateTime $createdAt The ISO 8601 formatted timestamp representing the creation time of the invitation.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $expiresAt The ISO 8601 formatted timestamp representing the expiration time of the invitation.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @var ?string $clientId Auth0 client ID. Used to resolve the application's login initiation endpoint.
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $connectionId The id of the connection to force invitee to authenticate with.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?array<string, mixed> $appMetadata
     */
    #[JsonProperty('app_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $appMetadata;

    /**
     * @var ?array<string, mixed> $userMetadata
     */
    #[JsonProperty('user_metadata'), ArrayType(['string' => 'mixed'])]
    private ?array $userMetadata;

    /**
     * @var ?array<string> $roles List of roles IDs to associated with the user.
     */
    #[JsonProperty('roles'), ArrayType(['string'])]
    private ?array $roles;

    /**
     * @var ?string $ticketId The id of the invitation ticket
     */
    #[JsonProperty('ticket_id')]
    private ?string $ticketId;

    /**
     * @param array{
     *   id?: ?string,
     *   organizationId?: ?string,
     *   inviter?: ?OrganizationInvitationInviter,
     *   invitee?: ?OrganizationInvitationInvitee,
     *   invitationUrl?: ?string,
     *   createdAt?: ?DateTime,
     *   expiresAt?: ?DateTime,
     *   clientId?: ?string,
     *   connectionId?: ?string,
     *   appMetadata?: ?array<string, mixed>,
     *   userMetadata?: ?array<string, mixed>,
     *   roles?: ?array<string>,
     *   ticketId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->organizationId = $values['organizationId'] ?? null;
        $this->inviter = $values['inviter'] ?? null;
        $this->invitee = $values['invitee'] ?? null;
        $this->invitationUrl = $values['invitationUrl'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->connectionId = $values['connectionId'] ?? null;
        $this->appMetadata = $values['appMetadata'] ?? null;
        $this->userMetadata = $values['userMetadata'] ?? null;
        $this->roles = $values['roles'] ?? null;
        $this->ticketId = $values['ticketId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getOrganizationId(): ?string
    {
        return $this->organizationId;
    }

    /**
     * @param ?string $value
     */
    public function setOrganizationId(?string $value = null): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
        return $this;
    }

    /**
     * @return ?OrganizationInvitationInviter
     */
    public function getInviter(): ?OrganizationInvitationInviter
    {
        return $this->inviter;
    }

    /**
     * @param ?OrganizationInvitationInviter $value
     */
    public function setInviter(?OrganizationInvitationInviter $value = null): self
    {
        $this->inviter = $value;
        $this->_setField('inviter');
        return $this;
    }

    /**
     * @return ?OrganizationInvitationInvitee
     */
    public function getInvitee(): ?OrganizationInvitationInvitee
    {
        return $this->invitee;
    }

    /**
     * @param ?OrganizationInvitationInvitee $value
     */
    public function setInvitee(?OrganizationInvitationInvitee $value = null): self
    {
        $this->invitee = $value;
        $this->_setField('invitee');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInvitationUrl(): ?string
    {
        return $this->invitationUrl;
    }

    /**
     * @param ?string $value
     */
    public function setInvitationUrl(?string $value = null): self
    {
        $this->invitationUrl = $value;
        $this->_setField('invitationUrl');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpiresAt(?DateTime $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
        return $this;
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
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getAppMetadata(): ?array
    {
        return $this->appMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setAppMetadata(?array $value = null): self
    {
        $this->appMetadata = $value;
        $this->_setField('appMetadata');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getUserMetadata(): ?array
    {
        return $this->userMetadata;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setUserMetadata(?array $value = null): self
    {
        $this->userMetadata = $value;
        $this->_setField('userMetadata');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @param ?array<string> $value
     */
    public function setRoles(?array $value = null): self
    {
        $this->roles = $value;
        $this->_setField('roles');
        return $this;
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
