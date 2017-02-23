<?php 
namespace Auth0\SDK\Helpers\Cache;
class ApcuCacheHandler implements CacheHandler
{
  protected $keyPrefix;
  protected $duration;
  
  public function __construct($keyPrefix = 'auth0-php', $duration = 300)
  {
    $this->keyPrefix = $keyPrefix;
    $this->duration = $duration;
  }
  
  public function get($key) 
  {
    $key = md5($this->keyPrefix.$key);
    $data = apcu_fetch($key);
    return (empty($data))?null:$data;
  }
  
  public function delete($key) 
  {
    $key = md5($this->keyPrefix.$key);
    apcu_delete($key);
  }
  
  public function set($key, $value) 
  {
    $key = md5($this->keyPrefix.$key);
    apcu_store($key, $value, $this->duration);
  }
}
