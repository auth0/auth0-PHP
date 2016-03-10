<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Header\ContentType;

class Stats extends GenericResource {

  public function getActiveUsersCount() {

    return $this->apiClient->get()
      ->stats()
      ->addPath('active-users')
      ->call();
  }

  public function getDailyStats($from, $to) {

    return $this->apiClient->get()
      ->stats()
      ->daily()
      ->withParam('from', $from)
      ->withParam('to', $to)
      ->call();
  }
}