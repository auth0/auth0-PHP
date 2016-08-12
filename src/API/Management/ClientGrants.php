<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class ClientGrants extends GenericResource 
{
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

  public function create($client_id, $audience, $scope) 
  {
    $request = $this->apiClient->post()
      ->addPath('client-grants')
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
          "client_id" => $client_id,
          "audience" => $audience,
          "scope" => $scope,
        ]));

    return $request->call();
  }

  public function delete($id, $audience = null) 
  {
    return $this->apiClient->delete()
      ->addPath('client-grants', $id)
      ->call()
  }

  public function update($id, $scope) 
  {
    $request = $this->apiClient->post()
      ->addPath('client-grants', $id)
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode([
          "scope" => $scope,
        ]));

    return $request->call();
  }
}