<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Tickets extends GenericResource {

    public function createEmailVerificationTicket($user_id, $result_url = null) {

        $body = array('user_id' => $user_id);
        if ($result_url !== null) {
            $body['result_url'] = $result_url;
        }

        $request = $this->apiClient->post()
            ->tickets()
            ->addPath('email-verification')
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($body));

        return $request->call();

    }

    public function createPasswordChangeTicket($user_id, $new_password = null, $result_url = null, $connection_id = null) {

        return $this->createPasswordChangeTicketRaw($user_id, null, $new_password, $result_url, $connection_id);
        
    }

    public function createPasswordChangeTicketByEmail($email, $new_password = null, $result_url = null, $connection_id = null) {

        return $this->createPasswordChangeTicketRaw(null, $mail, $new_password, $result_url, $connection_id);
        
    }

    public function createPasswordChangeTicketRaw($user_id = null, $email = null, $new_password = null, $result_url = null, $connection_id = null) {

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

        return $this->apiClient->post()
            ->tickets()
            ->addPath('password-change')
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($body))
            ->call();
    }
}