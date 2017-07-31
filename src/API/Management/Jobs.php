<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\BaseApi;
use Auth0\SDK\API\Helpers\ResponseMediator;
use Http\Message\MultipartStream\MultipartStreamBuilder;

final class Jobs extends BaseApi
{
    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        $response = $this->httpClient->get(sprintf('/jobs/%s', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function getErrors($id)
    {
        $response = $this->httpClient->get(sprintf('/jobs/%s/errors', $id));

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $filePath
     * @param string $connectionId
     *
     * @return mixed
     */
    public function importUsers($filePath, $connectionId)
    {
        $resource = fopen($filePath, 'r');
        $streamBuilder = new MultipartStreamBuilder();
        $streamBuilder->addResource('users', $resource);
        $streamBuilder->addResource('connection_id', $connectionId);
        $stream = $streamBuilder->build();
        $boundary = $streamBuilder->getBoundary();

        $response = $this->httpClient->post('/jobs/users-imports', ['Content-Type' => 'multipart/form-data; boundary="'.$boundary.'"'], $stream);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function sendVerificationEmail($userId)
    {
        $response = $this->httpClient->post('/jobs/verification-email', [], json_encode([
          'user_id' => $userId,
        ]));

        return ResponseMediator::getContent($response);
    }
}
