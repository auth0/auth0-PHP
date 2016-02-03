<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Jobs {

  protected $apiClient;

  public function __construct(ApiClient $apiClient) {
    $this->apiClient = $apiClient;
  }

  public function get($id) {

    return $this->apiClient->get()
      ->jobs($id)
      ->call();
  }

  public function importUsers($file_path, $connection_id) {

    return $this->apiClient->post()
      ->jobs()
      ->addPath('users-imports')
      ->addFile('users', $file_path)
      ->addFormParam('connection_id', $connection_id)
      ->call();
  }

  public function sendVerificationEmail($user_id) {

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