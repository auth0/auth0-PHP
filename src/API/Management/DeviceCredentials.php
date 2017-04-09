<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class DeviceCredentials extends GenericResource
{
    const TYPE_PUBLIC_KEY = 'public_key';
    const TYPE_REFESH_TOKEN = 'refresh_token';

  /**
   * @param string $user_id
   * @param string $client_id
   * @param string $type
   * @param null|string|array $fields
   * @param null|string|array $include_fields
   *
   * @return mixed
   */
  public function getAll($user_id = null, $client_id = null, $type = null, $fields = null, $include_fields = null)
  {
      $queryParams = [];

      if ($fields !== null) {
          if (is_array($fields)) {
              $fields = implode(',', $fields);
          }
          $queryParams['fields'] = $fields;
      }

      if ($include_fields !== null) {
          $queryParams['include_fields'] = $include_fields;
      }

      if ($user_id !== null) {
          $queryParams['user_id'] = $user_id;
      }

      if ($client_id !== null) {
          $queryParams['client_id'] = $client_id;
      }

      if ($type !== null) {
          $queryParams['type'] = $type;
      }

      $query = '';
      if (!empty($queryParams)) {
          $query = '?'.http_build_url($queryParams);
      }
      $response = $this->httpClient->get('/device-credentials'.$query);

      return ResponseMediator::getContent($response);
  }

  /**
   * @param array $data
   *
   * @return mixed
   */
  public function createPublicKey($data)
  {
      $response = $this->httpClient->post('/device-credentials', [], json_encode($data));

      return ResponseMediator::getContent($response);
  }

  /**
   * @param string $id
   *
   * @return mixed
   */
  public function deleteDeviceCredential($id)
  {
      $response = $this->httpClient->delete('/device-credentials/'.$id);

      return ResponseMediator::getContent($response);
  }
}
