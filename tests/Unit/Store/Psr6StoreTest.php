<?php

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
    expect($this->store->get($key))->toBe($value);
    expect($this->store->get('missing_key'))->toBe(null);

    $this->assertNotNull($randomKey = $this->public->get($this->storageKey));
    $this->public->delete($this->storageKey);
    expect($this->store->get($key))->toBe(null);

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
    expect($store->get($key))->toBe($value);
    expect($store->get('missing_key'))->toBe(null);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves a default value as expected', function(string $key): void {
    $this->store->set($key, null);

    expect($this->store->get($key, 'foobar'))->toBe(null);
    expect($this->store->get('missing_key', 'foobar'))->toBe('foobar');
    expect($this->store->get('missing_key'))->toBe(null);
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
    $this->store->delete($key);
    expect($this->store->get($key))->toBeNull();

    $this->store->set($key, $value);
    $this->store->delete($key);
    expect($this->store->get($key))->toBeNull();
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('purge() clears values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);

    $this->store->purge();
    expect($this->store->get($key))->toBeNull();
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
