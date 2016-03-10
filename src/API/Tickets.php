<?php

namespace Auth0\SDK\API;

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

    public function createPasswordChangeTicket($user_id, $new_password, $result_url = null) {

        $body = array(
            'user_id' => $user_id,
            'new_password' => $new_password
        );

        if ($result_url) {
            $body['result_url'] = $result_url;
        }

        return $this->apiClient->post()
            ->tickets()
            ->addPath('password-change')
            ->withBody(json_encode($body))
            ->call();

    }
}