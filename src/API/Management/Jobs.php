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
        ->addPath('jobs', $id)
        ->addPath('errors')
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
        ->addPath('jobs')
        ->addPath('users-imports')
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
     *
     * @param  string $user_id
     * @return mixed
     */
    public function sendVerificationEmail($user_id)
    {
        return $this->apiClient->method('post')
        ->addPath('jobs')
        ->addPath('verification-email')
        ->withBody(json_encode([
            'user_id' => $user_id
        ]))
        ->call();
    }
}
