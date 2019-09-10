<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Header\ContentType;

class Jobs extends GenericResource
{
    /**
     *
     * @param  string $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->apiClient->get()
        ->jobs($id)
        ->call();
    }

    /**
     *
     * @param  string $id
     * @return mixed
     */
    public function getErrors($id)
    {
        return $this->apiClient->get()
        ->jobs($id)
        ->errors()
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
        $request = $this->apiClient->post()
        ->jobs()
        ->addPath('users-imports')
        ->addFile('users', $file_path)
        ->addFormParam('connection_id', $connection_id);

        if (isset($params['upsert'])) {
            $request->addFormParam('upsert', filter_var($params['upsert'], FILTER_VALIDATE_BOOLEAN));
        }

        if (isset($params['send_completion_email'])) {
            $request->addFormParam('send_completion_email', filter_var($params['send_completion_email'], FILTER_VALIDATE_BOOLEAN));
        }

        if (!empty($params['external_id'])) {
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
        return $this->apiClient->post()
        ->jobs()
        ->addPath('verification-email')
        ->withHeader(new ContentType('application/json'))
        ->withBody(json_encode([
            'user_id' => $user_id
        ]))
        ->call();
    }
}
