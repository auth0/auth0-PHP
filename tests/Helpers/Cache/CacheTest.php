<?php
namespace Auth0\Tests\Helpers\Cache;

use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler;
use PHPUnit\Framework\TestCase;

class CacheTest extends TestCase
{
    public function testNoCache()
    {
        $cache = new NoCacheHandler();

        $this->assertNull($cache->get('pepe'));
        $cache->set('pepe', 'lala');

        $this->assertNull($cache->get('pepe'));
        $cache->delete('pepe');

        $this->assertNull($cache->get('pepe'));
    }

    public function testFileSystemCache()
    {
        $cache = new FileSystemCacheHandler();

        $this->assertNull($cache->get('pepe'));
        $cache->set('pepe', 'lala');

        $this->assertEquals('lala', $cache->get('pepe'));

        $cache->delete('pepe');
        $this->assertNull($cache->get('pepe'));
    }
}
