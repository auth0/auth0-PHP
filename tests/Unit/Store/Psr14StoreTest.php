<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Event\Psr14Store\Clear;
use Auth0\SDK\Event\Psr14Store\Defer;
use Auth0\SDK\Event\Psr14Store\Delete;
use Auth0\SDK\Event\Psr14Store\Destruct;
use Auth0\SDK\Event\Psr14Store\Get;
use Auth0\SDK\Event\Psr14Store\Set;
use Auth0\SDK\Store\Psr14Store;
use Auth0\Tests\Utilities\MockPsr14StoreListener;

uses()->group('storage', 'storage.psr14');

beforeEach(function(): void {
    $this->listener = new MockPsr14StoreListener();

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'eventListenerProvider' => $this->listener->setup()
    ]);
});

test('defer() behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());

    expect($this->listener->deferred)->toBe(false);
    $store->defer(true);
    expect($this->listener->deferred)->toBe(true);
});

test('set(), get() and purge() behave as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());
    $key = uniqid();
    $value = uniqid();

    $store->set($key, $value);
    expect($store->get($key))->toBe($value);
    expect($store->get('missing_key'))->toBe(null);
    expect($store->get('random_nonsense', 123))->toBe(123);

    $store->delete($key);
    expect($store->get($key))->toBe(null);
    expect($store->get($key, 123))->toBe(123);

    $key1 = $key . uniqid();
    $key2 = $key . uniqid();
    $key3 = $key . uniqid();
    $value1 = $value . uniqid();
    $value2 = $value . uniqid();
    $value3 = $value . uniqid();

    $store->set($key1, $value1);
    $store->set($key2, $value2);
    $store->set($key3, $value3);

    expect($store->get($key1))->toBe($value1);
    expect($store->get($key2))->toBe($value2);
    expect($store->get($key3))->toBe($value3);

    $store->delete($key2);

    expect($store->get($key1))->toBe($value1);
    expect($store->get($key2))->toBe(null);
    expect($store->get($key3))->toBe($value3);

    $store->purge();

    expect($store->get($key1))->toBe(null);
    expect($store->get($key2))->toBe(null);
    expect($store->get($key3))->toBe(null);
});

test('Boot event behaves as expected', function(): void {
    expect($this->listener->prefix)->toBe(null);

    $namespace = uniqid();
    $store = new Psr14Store($this->configuration, $namespace);

    expect($this->listener->prefix)->toBe(null);
    expect($this->listener->booted)->toBe(false);

    $store->set('test', uniqid());

    expect($this->listener->prefix)->toBe($namespace . '123');
    expect($this->listener->booted)->toBe(true);
});

test('Clear event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());
    $clear = new Clear($store);

    expect($clear->getStore())->toBe($store);

    expect($clear->getSuccess())->toBe(null);

    $clear->setSuccess(false);
    expect($clear->getSuccess())->toBe(false);

    $clear->setSuccess(true);
    expect($clear->getSuccess())->toBe(true);
});

test('Defer event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());

    $defer = new Defer($store, true);
    expect($defer->getStore())->toBe($store);
    expect($defer->getState())->toBe(true);

    $defer = new Defer($store, false);
    expect($defer->getStore())->toBe($store);
    expect($defer->getState())->toBe(false);
});

test('Delete event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());
    $key = uniqid();

    $delete = new Delete($store, $key);
    expect($delete->getStore())->toBe($store);
    expect($delete->getKey())->toBe($key);
    expect($delete->getSuccess())->toBe(null);

    $delete->setSuccess(false);
    expect($delete->getSuccess())->toBe(false);

    $delete->setSuccess(true);
    expect($delete->getSuccess())->toBe(true);
});

test('Destruct event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());

    $delete = new Destruct($store);
    expect($delete->getStore())->toBe($store);
});

test('Get event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());
    $key = uniqid();

    $get = new Get($store, $key);
    expect($get->getStore())->toBe($store);
    expect($get->getKey())->toBe($key);
    expect($get->getValue())->toBeNull();
    expect($get->getMissed())->toBeNull();
    expect($get->getSuccess())->toBeNull();

    $get->setValue(123);
    expect($get->getValue())->toBe(123);

    $get->setMissed(true);
    expect($get->getMissed())->toBe(true);

    $get->setMissed(false);
    expect($get->getMissed())->toBe(false);

    $get->setSuccess(true);
    expect($get->getSuccess())->toBe(true);

    $get->setSuccess(false);
    expect($get->getSuccess())->toBe(false);
});

test('Set event behaves as expected', function(): void {
    $store = new Psr14Store($this->configuration, uniqid());
    $key = uniqid();
    $value = uniqid();

    $set = new Set($store, $key, $value);
    expect($set->getStore())->toBe($store);
    expect($set->getKey())->toBe($key);
    expect($set->getValue())->toBe($value);
    expect($set->getSuccess())->toBeNull();

    $set->setSuccess(true);
    expect($set->getSuccess())->toBe(true);

    $set->setSuccess(false);
    expect($set->getSuccess())->toBe(false);
});
