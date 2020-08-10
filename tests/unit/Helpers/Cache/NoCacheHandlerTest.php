<?php
namespace Auth0\Tests\unit\Helpers\Cache;

use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use PHPUnit\Framework\TestCase;

class NoCacheHandlerTest extends TestCase
{
    public function testThatGetReturnsDefault() {
        $cache = new NoCacheHandler();
        $this->assertEquals('__test_default_value__', $cache->get(uniqid(), '__test_default_value__'));
    }

    public function testThatSetReturnsTrue() {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->set(uniqid(), uniqid()));
    }

    public function testThatDeleteReturnsTrue() {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->delete(uniqid()));
    }

    public function testThatClearReturnsTrue() {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->clear());
    }

    public function testThatSetMultipleReturnsNull() {
        $cache = new NoCacheHandler();
        $result = $cache->getMultiple(['key1', 'key2'], '__test_default_value__');

        $this->assertArrayHasKey('key1', $result);
        $this->assertArrayHasKey('key2', $result);
        $this->assertEquals('__test_default_value__', $result['key1']);
        $this->assertEquals('__test_default_value__', $result['key2']);
    }

    public function testThatSetMultipleReturnsTrue() {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->setMultiple([uniqid() => uniqid()]));
    }

    public function testThatDeleteMultipleReturnsTrue() {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->deleteMultiple([uniqid(), uniqid()]));
    }

    public function testThatHasReturnsFalse() {
        $cache = new NoCacheHandler();
        $this->assertFalse($cache->has(uniqid()));
    }
}
