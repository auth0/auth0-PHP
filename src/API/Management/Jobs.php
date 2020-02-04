<?php

namespace Auth0\SDK\API\Management;

class Jobs extends GenericResource
{
    /**
     *
     * @param  string $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->apiClient->method('get')
        ->addPath('jobs', $id)
        ->call();
    }

    /**
     *
     * @param  string $id
     * @return mixed
     */
    public function getErrors($id)
    {
        return $this->apiClient->method('get')
        ->addPath('jobs', $id, 'errors')
        ->call();
    }

    /**
     *
     * @param  string $file_path
     * @param  string $connection_id
     * @param  array  $params
     * @return mixed
     */
    public function importUsers($file_path, $connection_id, $params = [])
    {
        $request = $this->apiClient->method('post', false)
        ->addPath('jobs', 'users-imports')
        ->addFile('users', $file_path)
        ->addFormParam('connection_id', $connection_id);

        if (isset($params['upsert'])) {
            $request->addFormParam('upsert', filter_var($params['upsert'], FILTER_VALIDATE_BOOLEAN));
        }

        if (isset($params['send_completion_email'])) {
            $request->addFormParam('send_completion_email', filter_var($params['send_completion_email'], FILTER_VALIDATE_BOOLEAN));
        }

        if (! empty($params['external_id'])) {
            $request->addFormParam('external_id', $params['external_id']);
        }

        return $request->call();
    }

    /**
     * Create a verification email job.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID of the user to send the verification email to.
     * @param array  $params  Array of optional parameters to add.
     *        - client_id: Client ID of the requesting application.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email
     */
    public function sendVerificationEmail($user_id, array $params = [])
    {
        $body = [ 'user_id' => $user_id ];

        if (! empty( $params['client_id'] )) {
            $body['client_id'] = $params['client_id'];
        }

        return $this->apiClient->method('post')
            ->addPath('jobs', 'verification-email')
            ->withBody(json_encode($body))
            ->call();
    }
}
