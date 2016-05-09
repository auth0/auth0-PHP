<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Tenants extends GenericResource {

  public function get($fields = null, $include_fields = null) {

    $request = $this->apiClient->get()
      ->tenants()
      ->settings();

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

  public function update($data) {

    return $this->apiClient->patch()
      ->tenants()
      ->settings()
      ->call();
  }
    
}