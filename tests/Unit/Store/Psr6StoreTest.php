<?php

declare(strict_types=1);

declare(strict_types=1);

use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Store\MemoryStore;
use Auth0\SDK\Store\Psr6Store;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('storage', 'storage.psr6');

beforeEach(function(): void {
    $this->public = new MemoryStore();
    $this->private = new ArrayAdapter();
    $this->storageKey = uniqid();
    $this->store = new Psr6Store($this->public, $this->private, $this->storageKey);
});

test('set() and get() behave as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    $this->assertSame($value, $this->store->get($key));
    $this->assertSame(null, $this->store->get('missing_key'));

    $this->assertNotNull($randomKey = $this->public->get($this->storageKey));
    $this->public->delete($this->storageKey);
    $this->assertSame(null, $this->store->get($key));

    // Make sure we have a new key
    $this->assertNotSame($randomKey, $this->store->get($key));
    $this->assertNotNull($this->public->get($this->storageKey));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

it('stores data in private', function(string $key, string $value): void {
    $public = $this->getMockBuilder(StoreInterface::class)
        ->disableOriginalConstructor()
        ->onlyMethods(['set', 'get', 'delete', 'purge', 'defer'])
        ->getMock();

    $private = $this->getMockBuilder(CacheItemPoolInterface::class)
        ->disableOriginalConstructor()
        ->onlyMethods([
            'getItem', 'saveDeferred', 'getItems', 'hasItem', 'clear',
            'save', 'deleteItems', 'deleteItem', 'commit'
        ])
        ->getMock();

    $public->expects($this->atLeastOnce())->method('get')->with($this->storageKey)->willReturn('foobar');

    // Make sure we don't create a new key
    $public->expects($this->never())->method('set');

    $item = $this->getMockBuilder(CacheItemInterface::class)
        ->disableOriginalConstructor()
        ->onlyMethods(['get', 'set', 'getKey', 'isHit', 'expiresAt', 'expiresAfter'])
        ->getMock();

    $item->expects($this->once())->method('set')->with([$key=>$value]);
    $item->method('get')->willReturnOnConsecutiveCalls(null, [$key=>$value]);

    $private->method('getItem')->with('auth0_foobar')->willReturn($item);
    $private->method('saveDeferred')->willReturn(true);

    $store = new Psr6Store($public, $private, $this->storageKey);
    $store->set($key, $value);
    $this->assertSame($value, $store->get($key));
    $this->assertSame(null, $store->get('missing_key'));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves a default value as expected', function(string $key): void {
    $this->store->set($key, null);

    $this->assertSame(null, $this->store->get($key, 'foobar'));
    $this->assertSame('foobar', $this->store->get('missing_key', 'foobar'));
    $this->assertSame(null, $this->store->get('missing_key'));
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
    $this->store->delete($key);
    $this->assertNull($this->store->get($key));

    $this->store->set($key, $value);
    $this->store->delete($key);
    $this->assertNull($this->store->get($key));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('purge() clears values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);

    $this->store->purge();
    $this->assertNull($this->store->get($key));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
