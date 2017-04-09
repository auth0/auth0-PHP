<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Tickets extends GenericResource
{
    /**
     * @param string      $user_id
     * @param null|string $result_url
     *
     * @return mixed
     */
    public function createEmailVerificationTicket($user_id, $result_url = null)
    {
        $body = array('user_id' => $user_id);
        if ($result_url !== null) {
            $body['result_url'] = $result_url;
        }
        $response = $this->httpClient->post('/tickets/email-verification', [], json_encode($body));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string$user_id
     * @param null|string $new_password
     * @param null|string $result_url
     * @param null|string $connection_id
     *
     * @return mixed
     */
    public function createPasswordChangeTicket($user_id, $new_password = null, $result_url = null, $connection_id = null)
    {
        return $this->createPasswordChangeTicketRaw($user_id, null, $new_password, $result_url, $connection_id);
    }

    /**
     * @param string      $email
     * @param null|string $new_password
     * @param null|string $result_url
     * @param null|string $connection_id
     *
     * @return mixed
     */
    public function createPasswordChangeTicketByEmail($email, $new_password = null, $result_url = null, $connection_id = null)
    {
        return $this->createPasswordChangeTicketRaw(null, $email, $new_password, $result_url, $connection_id);
    }

    /**
     * @param null|string $user_id
     * @param null|string $email
     * @param null|string $new_password
     * @param null|string $result_url
     * @param null|string $connection_id
     *
     * @return mixed
     */
    public function createPasswordChangeTicketRaw($user_id = null, $email = null, $new_password = null, $result_url = null, $connection_id = null)
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

        $response = $this->httpClient->post('/tickets/password-change', [], json_encode($body));

        return ResponseMediator::getContent($response);
    }
}
