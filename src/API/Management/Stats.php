<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Stats extends GenericResource 
{
    /**
     * @return mixed
     */
  public function getActiveUsersCount() 
  {
    return $this->apiClient->get()
      ->stats()
      ->addPath('active-users')
      ->call();
  }

    /**
     * @param string $from
     * @param string $to
     * @return mixed
     */
  public function getDailyStats($from, $to) 
  {
    return $this->apiClient->get()
      ->stats()
      ->daily()
      ->withParam('from', $from)
      ->withParam('to', $to)
      ->call();
  }
}