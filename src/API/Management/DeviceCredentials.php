<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class DeviceCredentials extends GenericResource
{
    const TYPE_PUBLIC_KEY = 'public_key';
    const TYPE_REFESH_TOKEN = 'refresh_token';

  /**
   * @param string            $userId
   * @param string            $clientId
   * @param string            $type
   * @param null|string|array $fields
   * @param null|string|array $includeFields
   *
   * @return mixed
   */
  public function getAll($userId = null, $clientId = null, $type = null, $fields = null, $includeFields = null)
  {
      $queryParams = [];

      if ($fields !== null) {
          if (is_array($fields)) {
              $fields = implode(',', $fields);
          }
          $queryParams['fields'] = $fields;
      }

      if ($includeFields !== null) {
          $queryParams['include_fields'] = $includeFields;
      }

      if ($userId !== null) {
          $queryParams['user_id'] = $userId;
      }

      if ($clientId !== null) {
          $queryParams['client_id'] = $clientId;
      }

      if ($type !== null) {
          $queryParams['type'] = $type;
      }

      $query = '';
      if (!empty($queryParams)) {
          $query = '?'.http_build_query($queryParams);
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
