<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class ResourceServers extends GenericResource 
{
  public function get($id) 
  {
    return $this->apiClient->get()
      ->addPath('resource-servers', $id)
      ->call();
  }

  public function create($client_id, $data) 
  {
    return $this->apiClient->post()
      ->addPath('resource-servers')
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode( $data ))
      ->call();
  }

  public function delete($id) 
  {
    return $this->apiClient->delete()
      ->addPath('resource-servers', $id)
      ->call();
  }

  public function update($id, $data) 
  {
    return $this->apiClient->patch()
      ->addPath('resource-servers', $id)
      ->withHeader(new ContentType('application/json'))
      ->withBody(json_encode( $data ))
      ->call();
  }
}