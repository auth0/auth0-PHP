<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class UserBlocks {

  protected $apiClient;

  public function __construct(ApiClient $apiClient) {
    $this->apiClient = $apiClient;
  }

  public function get($user_id) {

    return $this->apiClient->get()
      ->addPath('user-blocks',$user_id)
      ->call();
  }

  public function unblock($user_id) {

    return $this->apiClient->delete()
      ->addPath('user-blocks',$user_id)
      ->call();
  }
}