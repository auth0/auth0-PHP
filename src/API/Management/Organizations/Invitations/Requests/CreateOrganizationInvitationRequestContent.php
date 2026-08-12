<?php

namespace Auth0\SDK\API\Management\Organizations\Invitations\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\OrganizationInvitationInviter;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\OrganizationInvitationInvitee;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class CreateOrganizationInvitationRequestContent extends JsonSerializableType
{
    /**
     * @var OrganizationInvitationInviter $inviter
     */
    #[JsonProperty('inviter')]
    private OrganizationInvitationInviter $inviter;

    /**
     * @var OrganizationInvitationInvitee $invitee
     */
    #[JsonProperty('invitee')]
    private OrganizationInvitationInvitee $invitee;

    /**
     * @var string $clientId Auth0 client ID. Used to resolve the application's login initiation endpoint.
     */
    #[JsonProperty('client_id')]
    private string $clientId;

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
     * @var ?int $ttlSec Number of seconds for which the invitation is valid before expiration. If unspecified or set to 0, this value defaults to 604800 seconds (7 days). Max value: 2592000 seconds (30 days).
     */
    #[JsonProperty('ttl_sec')]
    private ?int $ttlSec;

    /**
     * @var ?array<string> $roles List of roles IDs to associated with the user.
     */
    #[JsonProperty('roles'), ArrayType(['string'])]
    private ?array $roles;

    /**
     * @var ?bool $sendInvitationEmail Whether the user will receive an invitation email (true) or no email (false), true by default
     */
    #[JsonProperty('send_invitation_email')]
    private ?bool $sendInvitationEmail;

    /**
     * @param array{
     *   inviter: OrganizationInvitationInviter,
     *   invitee: OrganizationInvitationInvitee,
     *   clientId: string,
     *   connectionId?: ?string,
     *   appMetadata?: ?array<string, mixed>,
     *   userMetadata?: ?array<string, mixed>,
     *   ttlSec?: ?int,
     *   roles?: ?array<string>,
     *   sendInvitationEmail?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->inviter = $values['inviter'];
        $this->invitee = $values['invitee'];
        $this->clientId = $values['clientId'];
        $this->connectionId = $values['connectionId'] ?? null;
        $this->appMetadata = $values['appMetadata'] ?? null;
        $this->userMetadata = $values['userMetadata'] ?? null;
        $this->ttlSec = $values['ttlSec'] ?? null;
        $this->roles = $values['roles'] ?? null;
        $this->sendInvitationEmail = $values['sendInvitationEmail'] ?? null;
    }

    /**
     * @return OrganizationInvitationInviter
     */
    public function getInviter(): OrganizationInvitationInviter
    {
        return $this->inviter;
    }

    /**
     * @param OrganizationInvitationInviter $value
     */
    public function setInviter(OrganizationInvitationInviter $value): self
    {
        $this->inviter = $value;
        $this->_setField('inviter');
        return $this;
    }

    /**
     * @return OrganizationInvitationInvitee
     */
    public function getInvitee(): OrganizationInvitationInvitee
    {
        return $this->invitee;
    }

    /**
     * @param OrganizationInvitationInvitee $value
     */
    public function setInvitee(OrganizationInvitationInvitee $value): self
    {
        $this->invitee = $value;
        $this->_setField('invitee');
        return $this;
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
     * @return ?int
     */
    public function getTtlSec(): ?int
    {
        return $this->ttlSec;
    }

    /**
     * @param ?int $value
     */
    public function setTtlSec(?int $value = null): self
    {
        $this->ttlSec = $value;
        $this->_setField('ttlSec');
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
     * @return ?bool
     */
    public function getSendInvitationEmail(): ?bool
    {
        return $this->sendInvitationEmail;
    }

    /**
     * @param ?bool $value
     */
    public function setSendInvitationEmail(?bool $value = null): self
    {
        $this->sendInvitationEmail = $value;
        $this->_setField('sendInvitationEmail');
        return $this;
    }
}
