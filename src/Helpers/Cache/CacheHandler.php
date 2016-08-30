<?php 

namespace Auth0\SDK\Helpers\Cache;

interface CacheHandler {

  public function get($key);
  public function delete($key);
  public function set($key, $value);

}