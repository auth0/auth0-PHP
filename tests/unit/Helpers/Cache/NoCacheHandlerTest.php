<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\Helpers\Cache;

use Auth0\SDK\Helpers\Cache\NoCacheHandler;
use PHPUnit\Framework\TestCase;

class NoCacheHandlerTest extends TestCase
{
    public function testThatGetReturnsDefault(): void
    {
        $cache = new NoCacheHandler();
        $this->assertEquals('__test_default_value__', $cache->get(uniqid(), '__test_default_value__'));
    }

    public function testThatSetReturnsTrue(): void
    {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->set(uniqid(), uniqid()));
    }

    public function testThatDeleteReturnsTrue(): void
    {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->delete(uniqid()));
    }

    public function testThatClearReturnsTrue(): void
    {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->clear());
    }

    public function testThatSetMultipleReturnsNull(): void
    {
        $cache = new NoCacheHandler();
        $result = $cache->getMultiple(['key1', 'key2'], '__test_default_value__');

        $this->assertArrayHasKey('key1', $result);
        $this->assertArrayHasKey('key2', $result);
        $this->assertEquals('__test_default_value__', $result['key1']);
        $this->assertEquals('__test_default_value__', $result['key2']);
    }

    public function testThatSetMultipleReturnsTrue(): void
    {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->setMultiple([uniqid() => uniqid()]));
    }

    public function testThatDeleteMultipleReturnsTrue(): void
    {
        $cache = new NoCacheHandler();
        $this->assertTrue($cache->deleteMultiple([uniqid(), uniqid()]));
    }

    public function testThatHasReturnsFalse(): void
    {
        $cache = new NoCacheHandler();
        $this->assertFalse($cache->has(uniqid()));
    }
}
