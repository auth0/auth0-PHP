<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Exception\EmptyOrInvalidParameterException;

class Jobs extends GenericResource
{
    /**
     * Retrieves a job. Useful to check its status.
     * Required scopes: "create:users" "read:users"
     *
     * @param  string  $id
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id
     */
    public function get($id)
    {
        return $this->apiClient->method('get')
        ->addPath('jobs', $id)
        ->call();
    }

    /**
     * Retrieve error details of a failed job.
     * Required scopes: "create:users" "read:users"
     *
     * @param  string  $id
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_errors
     */
    public function getErrors($id)
    {
        return $this->apiClient->method('get')
        ->addPath('jobs', $id, 'errors')
        ->call();
    }

    /**
     * Import users from a formatted file into a connection via a long-running job.
     * Required scopes: "create:users" "read:users"
     *
     * @param  string  $file_path
     * @param  string  $connection_id
     * @param  array   $params
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports
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
     * Export all users to a file via a long-running job.
     * Required scopes: "read:users"
     *
     * @param  array  $params
     *
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
     *
     * @return mixed
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports
     */
    public function exportUsers($params = [])
    {
        $request = $this->apiClient->method('post')
        ->addPath('jobs', 'users-exports');

        $body = [];

        if (!empty($params['connection_id'])) {
            $body['connection_id'] = $params['connection_id'];
        }

        if (!empty($params['format']) && in_array($params['format'], ['json', 'csv'])) {
            $body['format'] = $params['format'];
        }

        if (!empty($params['limit']) && is_numeric($params['limit'])) {
            $body['limit'] = $params['limit'];
        }

        if (!empty($params['fields']) && is_array($params['fields'])) {
            $body['fields'] = $params['fields'];
        }

        return $request->withBody(json_encode($body), JSON_FORCE_OBJECT)->call();
    }

    /**
     * Create a verification email job.
     * Required scope: "update:users"
     *
     * @param string $user_id User ID of the user to send the verification email to.
     * @param array  $params  Array of optional parameters to add.
     *        - client_id: Client ID of the requesting application. If not provided, the global Client ID will be used.
     *        - identity:  The optional identity of the user, as an array. Required to verify primary identities when using social, enterprise, or passwordless connections. It is also required to verify secondary identities.
     *              - user_id: User ID of the identity to be verified. Must be a non-empty string.
     *              - provider: Identity provider name of the identity (e.g. google-oauth2). Must be a non-empty string.
     *
     * @throws EmptyOrInvalidParameterException Thrown if any required parameters are empty or invalid.
     * @throws \Exception Thrown by the HTTP client when there is a problem with the API call.
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

        if (! empty( $params['identity'] )) {
            if ( empty( $params['identity']['user_id']) || ! is_string($params['identity']['user_id']) ) {
                throw new EmptyOrInvalidParameterException('Missing required "user_id" field of the "identity" object.');
            }
            if ( empty( $params['identity']['provider'] ) || ! is_string($params['identity']['provider']) ) {
                throw new EmptyOrInvalidParameterException('Missing required "provider" field of the "identity" object.');
            }
            $body['identity'] = $params['identity'];
        }

        return $this->apiClient->method('post')
            ->addPath('jobs', 'verification-email')
            ->withBody(json_encode($body))
            ->call();
    }
}
