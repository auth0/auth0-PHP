<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Emails {

  protected $apiClient;

  public function __construct(ApiClient $apiClient) {
      $this->apiClient = $apiClient;
  }

  public function getEmailProvider($fields = null, $include_fields = null) {

    $request = $this->apiClient->get()
        ->emails()
        ->provider();

    if ($fields !== null) {
      if (is_array($fields)) {
        $fields = implode(',', $fields);
      }
      $request->withParam('fields', $fields);
    }
    if ($include_fields !== null) {
      $request->withParam('include_fields', $include_fields);
    }

    $info = $request->call();

    return $info;
  }

  public function configureEmailProvider($data) {

    $info = $this->apiClient->post()
      ->emails()
      ->provider()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();

    return $info;
  }

  public function updateEmailProvider($data) {

    $info = $this->apiClient->patch()
      ->emails()
      ->provider()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();

    return $info;
  }

  public function deleteEmailProvider() {

    $request = $this->apiClient->delete()
      ->emails()
      ->provider()
      ->call();
  }
}