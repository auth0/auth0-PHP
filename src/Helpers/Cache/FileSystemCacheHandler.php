<?php 

namespace Auth0\SDK\Helpers\Cache;

class FileSystemCacheHandler implements CacheHandler 
{
  protected $tmp_dir;

  public function __construct($temp_directory_prefix = 'auth0-php') 
  {
    $this->tmp_dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $temp_directory_prefix . DIRECTORY_SEPARATOR;
    if (!file_exists($this->tmp_dir)) {
      mkdir($this->tmp_dir);
    }
  }

  public function get($key) 
  {
    $key = md5($key);

    if (!file_exists($this->tmp_dir .  $key)) {
      return null;
    }

    $file = fopen($this->tmp_dir .  $key, "r");
    flock($file, LOCK_EX);

    $data = fgets($file);


    flock($file, LOCK_UN);
    fclose ( $file );

    return unserialize(base64_decode($data));
  }

  public function delete($key) 
  {
    $key = md5($key);
    $this->set($key, null);
    @unlink($this->tmp_dir . $key);
  }
  
  public function set($key, $value) 
  {
    $key = md5($key);
    $value = base64_encode(serialize($value));

    $file = fopen($this->tmp_dir . $key, "w+");
    flock($file, LOCK_EX);

    fwrite ( $file, $value, strlen($value) );

    flock($file, LOCK_UN);
    fclose ( $file );
  }
}