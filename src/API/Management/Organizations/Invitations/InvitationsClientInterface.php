<?php

namespace Auth0\SDK\API\Management\Organizations\Invitations;

use Auth0\SDK\API\Management\Organizations\Invitations\Requests\ListOrganizationInvitationsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationInvitation;
use Auth0\SDK\API\Management\Organizations\Invitations\Requests\CreateOrganizationInvitationRequestContent;
use Auth0\SDK\API\Management\Types\CreateOrganizationInvitationResponseContent;
use Auth0\SDK\API\Management\Organizations\Invitations\Requests\GetOrganizationInvitationRequestParameters;
use Auth0\SDK\API\Management\Types\GetOrganizationInvitationResponseContent;

interface InvitationsClientInterface
{
    /**
     * Retrieve a detailed list of invitations sent to users for a specific Organization. The list includes details such as inviter and invitee information, invitation URLs, and dates of creation and expiration. To learn more about Organization invitations, review <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">Invite Organization Members</a>.
     *
     * @param string $id Organization identifier.
     * @param ListOrganizationInvitationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationInvitation>
     */
    public function list(string $id, ListOrganizationInvitationsRequestParameters $request = new ListOrganizationInvitationsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a user invitation for a specific Organization. Upon creation, the listed user receives an email inviting them to join the Organization. To learn more about Organization invitations, review <a href="https://auth0.com/docs/manage-users/organizations/configure-organizations/invite-members">Invite Organization Members</a>.
     *
     * @param string $id Organization identifier.
     * @param CreateOrganizationInvitationRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationInvitationResponseContent
     */
    public function create(string $id, CreateOrganizationInvitationRequestContent $request, ?array $options = null): ?CreateOrganizationInvitationResponseContent;

    /**
     * @param string $id Organization identifier.
     * @param string $invitationId The id of the user invitation.
     * @param GetOrganizationInvitationRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationInvitationResponseContent
     */
    public function get(string $id, string $invitationId, GetOrganizationInvitationRequestParameters $request = new GetOrganizationInvitationRequestParameters(), ?array $options = null): ?GetOrganizationInvitationResponseContent;

    /**
     * @param string $id Organization identifier.
     * @param string $invitationId The id of the user invitation.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $invitationId, ?array $options = null): void;
}
