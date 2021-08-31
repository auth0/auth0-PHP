<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\MemoryStore;
use Auth0\SDK\Utility\TransientStoreHandler;

uses()->group('utility', 'utility.transient_store_handler');

beforeEach(function(): void {
    $this->namespace = uniqid();

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
    ]);

    $this->store = new MemoryStore($this->configuration, $this->namespace);
    $this->transient = new TransientStoreHandler($this->store);
});

test('getStore() returns the assigned storage instance', function(): void {
    $this->assertEquals($this->store, $this->transient->getStore());
});

test('store() assigns data correctly', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    $this->assertEquals($value, $this->store->get($key));
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('issue() assigns data correctly', function(string $key): void {
    $value = $this->transient->issue($key);

    $this->assertEquals($value, $this->store->get($key));
    $this->assertGreaterThanOrEqual(16, mb_strlen($value));
})->with(['random key' => [
    fn() => uniqid(),
]]);

test('getOnce() assigns data correctly and is only retrievable once', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    $this->assertEquals($value, $this->store->get($key));
    $this->assertEquals($value, $this->transient->getOnce($key));
    $this->assertNull($this->transient->getOnce($key));
    $this->assertNull($this->store->get($key));
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('verify() correctly verifies data', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    $this->assertTrue($this->transient->verify($key, $value));
    $this->assertFalse($this->transient->verify($key, $value));
    $this->assertNull($this->transient->getOnce($key));
    $this->assertNull($this->store->get($key));
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('isset() returns correct state', function(string $key, string $value): void {
    $this->assertFalse($this->transient->isset($key));

    $this->transient->store($key, $value);

    $this->assertTrue($this->transient->isset($key));

    $this->transient->getOnce($key);

    $this->assertFalse($this->transient->isset($key));
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
