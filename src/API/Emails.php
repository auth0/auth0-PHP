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

    return $request->call();
  }

  public function configureEmailProvider($data) {

    return $this->apiClient->post()
      ->emails()
      ->provider()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

  public function updateEmailProvider($data) {

    return $this->apiClient->patch()
      ->emails()
      ->provider()
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();
  }

  public function deleteEmailProvider() {

    return $this->apiClient->delete()
      ->emails()
      ->provider()
      ->call();
  }
}