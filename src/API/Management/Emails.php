<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;

class Emails extends GenericResource
{
    /**
   * @param null|string|array $fields
   * @param null|string|array $include_fields
   *
   * @return mixed
   */
  public function getEmailProvider($fields = null, $include_fields = null)
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

      $query = '';
      if (!empty($queryParams)) {
          $query = '?'.http_build_query($queryParams);
      }
      $response = $this->httpClient->get('/emails/provider'.$query);

      return ResponseMediator::getContent($response);
  }

  /**
   * @param array $data
   *
   * @return mixed
   */
  public function configureEmailProvider($data)
  {
      $response = $this->httpClient->post('/emails/provider', [], json_encode($data));

      return ResponseMediator::getContent($response);
  }

  /**
   * @param array $data
   *
   * @return mixed
   */
  public function updateEmailProvider($data)
  {
      $response = $this->httpClient->patch('/emails/provider', [], json_encode($data));

      return ResponseMediator::getContent($response);
  }

  /**
   * @return mixed
   */
  public function deleteEmailProvider()
  {
      $response = $this->httpClient->delete('/emails/provider');

      return ResponseMediator::getContent($response);
  }
}
