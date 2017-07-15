<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;
use Http\Message\MultipartStream\MultipartStreamBuilder;

final class Jobs extends GenericResource
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
     * @param string $file_path
     * @param string $connection_id
     *
     * @return mixed
     */
    public function importUsers($file_path, $connection_id)
    {
        $resource = fopen($file_path, 'r');
        $streamBuilder = new MultipartStreamBuilder();
        $streamBuilder->addResource('users', $resource);
        $streamBuilder->addResource('connection_id', $connection_id);
        $stream = $streamBuilder->build();
        $boundary = $streamBuilder->getBoundary();

        $response = $this->httpClient->post('/jobs/users-imports', ['Content-Type' => 'multipart/form-data; boundary="'.$boundary.'"'], $stream);

        return ResponseMediator::getContent($response);
    }

    /**
     * @param string $user_id
     *
     * @return mixed
     */
    public function sendVerificationEmail($user_id)
    {
        $response = $this->httpClient->post('/jobs/verification-email', [], json_encode([
          'user_id' => $user_id,
        ]));

        return ResponseMediator::getContent($response);
    }
}
