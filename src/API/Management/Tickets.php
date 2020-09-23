<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;

class Tickets extends GenericResource
{
    /**
     *
     * @param  string      $user_id
     * @param  null|string $result_url
     * @param array  $params  Array of optional parameters to add.
     *      - client_id: Client ID of the requesting application.
     *      - identity:  The optional identity of the user, as an array. Required to verify primary identities when using social, enterprise, or passwordless connections. It is also required to verify secondary identities.
     *              - user_id: User ID of the identity to be verified.
     *              - provider: Identity provider name of the identity (e.g. google-oauth2).
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

        if (! empty( $params['identity'] )) {
            if ( empty( $params['identity']['user_id']) || ! is_string($params['identity']['user_id']) ) {
                throw new EmptyOrInvalidParameterException('Missing required "user_id" field of the "identity" object.');
            }
            if ( empty( $params['identity']['provider'] ) || ! is_string($params['identity']['provider']) ) {
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
     * @param  string      $user_id
     * @param  null|string $new_password
     * @param  null|string $result_url
     * @param  null|string $connection_id
     * @return mixed
     */
    public function createPasswordChangeTicket(
        $user_id,
        $new_password = null,
        $result_url = null,
        $connection_id = null
    )
    {
        return $this->createPasswordChangeTicketRaw($user_id, null, $new_password, $result_url, $connection_id);
    }

    /**
     *
     * @param  string      $email
     * @param  null|string $new_password
     * @param  null|string $result_url
     * @param  null|string $connection_id
     * @return mixed
     */
    public function createPasswordChangeTicketByEmail(
        $email,
        $new_password = null,
        $result_url = null,
        $connection_id = null
    )
    {
        return $this->createPasswordChangeTicketRaw(null, $email, $new_password, $result_url, $connection_id);
    }

    /**
     *
     * @param  null|string $user_id
     * @param  null|string $email
     * @param  null|string $new_password
     * @param  null|string $result_url
     * @param  null|string $connection_id
     * @return mixed
     */
    public function createPasswordChangeTicketRaw(
        $user_id = null,
        $email = null,
        $new_password = null,
        $result_url = null,
        $connection_id = null
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

        return $this->apiClient->method('post')
            ->addPath('tickets', 'password-change')
            ->withBody(json_encode($body))
            ->call();
    }
}
