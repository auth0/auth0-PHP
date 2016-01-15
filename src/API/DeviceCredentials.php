<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class DeviceCredentials {

  const TYPE_PUBLIC_KEY = 'public_key';
  const TYPE_REFESH_TOKEN = 'refresh_token';

  protected $apiClient;

  public function __construct(ApiClient $apiClient) {
    $this->apiClient = $apiClient;
  }

  public function getAll($user_id = null, $client_id = null, $type = null, $fields = null, $include_fields = null) {

    $request = $this->apiClient->get()
        ->addPath('device-credentials');

    if ($fields !== null) {
      if (is_array($fields)) {
        $fields = implode(',', $fields);
      }
      $request->withParam('fields', $fields);
    }
    if ($include_fields !== null) {
      $request->withParam('include_fields', $include_fields);
    }
    if ($user_id !== null) {
      $request->withParam('user_id', $user_id);
    }     
    if ($client_id !== null) {
      $request->withParam('client_id', $client_id);
    }    
    if ($type !== null) {
      $request->withParam('type', $type);
    }

    $info = $request->call();

    return $info;
  }

  public function createPublicKey($data) {

    $info = $this->apiClient->post()
      ->addPath('device-credentials');
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode($data))
      ->call();

    return $info;
  }

  public function deleteDeviceCredential($id) {

    $request = $this->apiClient->delete()
      ->addPath('device-credentials', $id)
      ->call();
  }
}