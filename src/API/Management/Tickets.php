<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;

class Tickets extends GenericResource
{
    /**
     *
     * @param string      $user_id    ID of the user for whom the ticket should be created.
     * @param null|string $result_url URL the user will be redirected to in the classic Universal Login experience once the ticket is used.
     * @param array       $params     Array of optional parameters to add.
     *                                - ttl_sec: Number of seconds for which the ticket is valid before expiration. If unspecified or set to 0, this value defaults to 432000 seconds (5 days).
     *                                - includeEmailInRedirect: Whether to include the email address as part of the returnUrl in the reset_email (true), or not (false).
     *                                - identity:  The optional identity of the user, as an array. Required to verify primary identities when using social, enterprise, or passwordless connections. It is also required to verify secondary identities.
     *                                - user_id: User ID of the identity to be verified. Must be a non-empty string.
     *                                - provider: Identity provider name of the identity (e.g. google-oauth2). Must be a non-empty string.
     *                                - client_id: ID of the client. If provided for tenants using New Universal Login experience, the user will be prompted to redirect to the default login route of the corresponding application once the ticket is created.
     *                                - organization_id: ID of the organization. If provided, the organization_id and organization_name will be included as query arguments in the link back to the application.
     *
     * @throws EmptyOrInvalidParameterException Thrown if any required parameters are empty or invalid.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     */
    public function createEmailVerificationTicket($user_id, $result_url = null, array $params = [])
    {
        $body = ['user_id' => $user_id];

        if ($result_url !== null) {
            $body['result_url'] = $result_url;
        }

        if (! empty( $params['client_id'] )) {
            $body['client_id'] = $params['client_id'];
        }

        if (! empty( $params['organization_id'] )) {
            $body['organization_id'] = $params['organization_id'];
        }

        if (! empty( $params['identity'] )) {
            if (empty( $params['identity']['user_id']) || ! is_string($params['identity']['user_id'])) {
                throw new EmptyOrInvalidParameterException('Missing required "user_id" field of the "identity" object.');
            }

            if (empty( $params['identity']['provider'] ) || ! is_string($params['identity']['provider'])) {
                throw new EmptyOrInvalidParameterException('Missing required "provider" field of the "identity" object.');
            }

            $body['identity'] = $params['identity'];
        }

        $request = $this->apiClient->method('post')
            ->addPath('tickets', 'email-verification')
            ->withBody(json_encode($body));

        return $request->call();
    }

    /**
     *
     * @param null|string  $user_id         User for whom the ticket should be created. Conflicts with: $connection_id
     * @param null|string  $new_password    New password to assign to the user.
     * @param null|string  $result_url      URL the user will be redirected to in the classic Universal Login experience once the ticket is used.
     * @param null|string  $connection_id   Connection to use, allowing user to be specified using $email, rather than $user_id. Requires $email. Conflicts with $user_id.
     * @param null|integer $ttl             Number of seconds this ticket will be valid before expiring. Defaults to 432000 seconds (5 days.)
     * @param null|string  $client_id       If provided for tenants using New Universal Login experience, the user will be prompted to redirect to the default login route of the corresponding application once the ticket is used.
     * @param null|string  $organization_id If provided, the organization_id and organization_name will be included as query arguments in the link back to the application.
     *
     * @return mixed
     */
    public function createPasswordChangeTicket(
        $user_id,
        $new_password = null,
        $result_url = null,
        $connection_id = null,
        $ttl = null,
        $client_id = null,
        $organization_id = null
    )
    {
        return $this->createPasswordChangeTicketRaw($user_id, null, $new_password, $result_url, $connection_id, $ttl, $client_id, $organization_id);
    }

    /**
     *
     * @param null|string  $email           Email address of the user for whom the ticket should be created. Requires $connection_id.
     * @param null|string  $new_password    New password to assign to the user.
     * @param null|string  $result_url      URL the user will be redirected to in the classic Universal Login experience once the ticket is used.
     * @param null|string  $connection_id   Connection to use, allowing user to be specified using $email, rather than $user_id. Requires $email. Conflicts with $user_id.
     * @param null|integer $ttl             Number of seconds this ticket will be valid before expiring. Defaults to 432000 seconds (5 days.)
     * @param null|string  $client_id       If provided for tenants using New Universal Login experience, the user will be prompted to redirect to the default login route of the corresponding application once the ticket is used.
     * @param null|string  $organization_id If provided, the organization_id and organization_name will be included as query arguments in the link back to the application.
     *
     * @return mixed
     */
    public function createPasswordChangeTicketByEmail(
        $email,
        $new_password = null,
        $result_url = null,
        $connection_id = null,
        $ttl = null,
        $client_id = null,
        $organization_id = null
    )
    {
        return $this->createPasswordChangeTicketRaw(null, $email, $new_password, $result_url, $connection_id, $ttl, $client_id, $organization_id);
    }

    /**
     *
     * @param null|string  $user_id         User for whom the ticket should be created. Conflicts with: $connection_id, $email
     * @param null|string  $email           Email address of the user for whom the ticket should be created. Requires $connection_id. Conflicts with $user_id.
     * @param null|string  $new_password    New password to assign to the user.
     * @param null|string  $result_url      URL the user will be redirected to in the classic Universal Login experience once the ticket is used.
     * @param null|string  $connection_id   Connection to use, allowing user to be specified using $email, rather than $user_id. Requires $email. Conflicts with $user_id.
     * @param null|integer $ttl             Number of seconds this ticket will be valid before expiring. Defaults to 432000 seconds (5 days.)
     * @param null|string  $client_id       If provided for tenants using New Universal Login experience, the user will be prompted to redirect to the default login route of the corresponding application once the ticket is used.
     * @param null|string  $organization_id If provided, the organization_id and organization_name will be included as query arguments in the link back to the application.
     *
     * @return mixed
     */
    public function createPasswordChangeTicketRaw(
        $user_id = null,
        $email = null,
        $new_password = null,
        $result_url = null,
        $connection_id = null,
        $ttl = null,
        $client_id = null,
        $organization_id = null
    )
    {
        $body = [];

        if ($user_id) {
            $body['user_id'] = $user_id;
        }

        if ($email) {
            $body['email'] = $email;
        }

        if ($new_password) {
            $body['new_password'] = $new_password;
        }

        if ($result_url) {
            $body['result_url'] = $result_url;
        }

        if ($connection_id) {
            $body['connection_id'] = $connection_id;
        }

        if ($ttl) {
            $body['ttl_sec'] = $ttl;
        }

        if ($client_id) {
            $body['client_id'] = $client_id;
        }

        if ($organization_id) {
            $body['organization_id'] = $organization_id;
        }

        return $this->apiClient->method('post')
            ->addPath('tickets', 'password-change')
            ->withBody(json_encode($body))
            ->call();
    }
}
