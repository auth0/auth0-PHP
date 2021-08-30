<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Store;

use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Store\InMemoryStorage;
use Auth0\SDK\Store\Psr6Store;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Psr6StoreTest extends TestCase
{
    private const PUBLIC_STORAGE_KEY = 'storage_key';

    public function testSetGet(): void
    {
        $public = new InMemoryStorage();
        $private = new ArrayAdapter();
        $store = new Psr6Store($public, $private);
        $store->set('test_set_key', '__test_set_value__');
        $this->assertSame('__test_set_value__', $store->get('test_set_key'));
        $this->assertSame(null, $store->get('missing_key'));

        $this->assertNotNull($randomKey = $public->get(self::PUBLIC_STORAGE_KEY));
        $public->delete(self::PUBLIC_STORAGE_KEY);
        $this->assertSame(null, $store->get('test_set_key'));

        // Make sure we have a new key
        $this->assertNotSame($randomKey, $store->get('test_set_key'));
        $this->assertNotNull($public->get(self::PUBLIC_STORAGE_KEY));
    }

    public function testDataIsStoredInPrivate(): void
    {
        $public = $this->getMockBuilder(StoreInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['set', 'get', 'delete', 'purge', 'defer'])
            ->getMock();
        $public->expects($this->atLeastOnce())->method('get')->with(self::PUBLIC_STORAGE_KEY)->willReturn('foobar');
        // Make sure we don't create a new key
        $public->expects($this->never())->method('set');

        $private = $this->getMockBuilder(CacheItemPoolInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods([
                'getItem', 'saveDeferred', 'getItems', 'hasItem', 'clear',
                'save', 'deleteItems', 'deleteItem', 'commit'
            ])
            ->getMock();

        $item = $this->getMockBuilder(CacheItemInterface::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['get', 'set', 'getKey', 'isHit', 'expiresAt', 'expiresAfter'])
            ->getMock();
        $item->expects($this->once())->method('set')->with(['test_set_key'=>'__test_set_value__']);
        $item->method('get')->willReturnOnConsecutiveCalls(null, ['test_set_key'=>'__test_set_value__']);

        $private->method('getItem')->with('auth0_foobar')->willReturn($item);
        $private->method('saveDeferred')->willReturn(true);

        $store = new Psr6Store($public, $private);
        $store->set('test_set_key', '__test_set_value__');
        $this->assertSame('__test_set_value__', $store->get('test_set_key'));
        $this->assertSame(null, $store->get('missing_key'));
    }

    public function testGetDefault(): void
    {
        $public = new InMemoryStorage();
        $private = new ArrayAdapter();
        $store = new Psr6Store($public, $private);
        $store->set('test_set_key', null);
        $this->assertSame(null, $store->get('test_set_key', 'foobar'));
        $this->assertSame('foobar', $store->get('missing_key', 'foobar'));
        $this->assertSame(null, $store->get('missing_key'));
    }

    public function testDelete(): void
    {
        $public = new InMemoryStorage();
        $private = new ArrayAdapter();
        $store = new Psr6Store($public, $private);
        $store->set('test_set_key', '__test_set_value__');

        $store->delete('test_set_key');
        $this->assertNull($store->get('test_set_key'));
    }

    public function testPurge(): void
    {
        $public = new InMemoryStorage();
        $private = new ArrayAdapter();
        $store = new Psr6Store($public, $private);
        $store->set('test_set_key', '__test_set_value__');

        $store->purge();
        $this->assertNull($store->get('test_set_key'));
    }
}
