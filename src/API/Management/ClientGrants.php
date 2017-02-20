<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class ClientGrants extends GenericResource 
{
    /**
     * @param string $id
     * @param null|string $audience
     * @return mixed
     */
  public function get($id, $audience = null) 
  {
    $request = $this->apiClient->get()
      ->addPath('client-grants');

    if ($audience !== null) 
    {
      $request = $request->withParam('audience', $audience);
    }

    return $request->call();
  }

    /**
     * @param string $client_id
     * @param string $audience
     * @param string $scope
     * @return mixed
     */
  public function create($client_id, $audience, $scope) 
  {
    return $this->apiClient->post()
      ->addPath('client-grants')
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
          "client_id" => $client_id,
          "audience" => $audience,
          "scope" => $scope,
        ]))
      ->call();
  }

    /**
     * @param string $id
     * @param null|string $audience
     * @return mixed
     */
  public function delete($id, $audience = null) 
  {
    return $this->apiClient->delete()
      ->addPath('client-grants', $id)
      ->call();
  }

    /**
     * @param string $id
     * @param string $scope
     * @return mixed
     */
  public function update($id, $scope) 
  {
    return $this->apiClient->patch()
      ->addPath('client-grants', $id)
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
          "scope" => $scope,
        ]))
      ->call();
  }
}