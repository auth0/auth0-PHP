<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;

final class Tickets extends BaseApi
{
    /**
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_email_verification
     *
     * @param string      $userId
     * @param null|string $resultUrl
     *
     * @return mixed
     */
    public function createEmailVerificationTicket($userId, $resultUrl = null)
    {
        $body = ['user_id' => $userId];
        if ($resultUrl !== null) {
            $body['result_url'] = $resultUrl;
        }
        $response = $this->httpClient->post('/tickets/email-verification', [], json_encode($body));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }

    /**
     * @param string      $userId
     * @param null|string $newPassword
     * @param null|string $resultUrl
     * @param null|string $connectionId
     *
     * @return mixed
     */
    public function createPasswordChangeTicket($userId, $newPassword = null, $resultUrl = null, $connectionId = null)
    {
        return $this->createPasswordChangeTicketRaw($userId, null, $newPassword, $resultUrl, $connectionId);
    }

    /**
     * @param string      $email
     * @param null|string $newPassword
     * @param null|string $resultUrl
     * @param null|string $connectionId
     *
     * @return mixed
     */
    public function createPasswordChangeTicketByEmail($email, $newPassword = null, $resultUrl = null, $connectionId = null)
    {
        return $this->createPasswordChangeTicketRaw(null, $email, $newPassword, $resultUrl, $connectionId);
    }

    /**
     * @link https://auth0.com/docs/api/management/v2#!/Tickets/post_password_change
     *
     * @param null|string $userId
     * @param null|string $email
     * @param null|string $newPassword
     * @param null|string $resultUrl
     * @param null|string $connectionId
     *
     * @return mixed
     */
    public function createPasswordChangeTicketRaw($userId = null, $email = null, $newPassword = null, $resultUrl = null, $connectionId = null)
    {
        $body = [];

        if ($userId) {
            $body['user_id'] = $userId;
        }
        if ($email) {
            $body['email'] = $email;
        }
        if ($newPassword) {
            $body['new_password'] = $newPassword;
        }
        if ($resultUrl) {
            $body['result_url'] = $resultUrl;
        }
        if ($connectionId) {
            $body['connection_id'] = $connectionId;
        }

        $response = $this->httpClient->post('/tickets/password-change', [], json_encode($body));

        if (201 === $response->getStatusCode()) {
            return ResponseMediator::getContent($response);
        }

        $this->handleExceptions($response);
    }
}
