<?php namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;

class GenericResource { 

  protected $apiClient;

  public function __construct(ApiClient $apiClient) {
      $this->apiClient = $apiClient;
  }

  public function getApiClient() {
    return $this->apiClient;
  }
  
}