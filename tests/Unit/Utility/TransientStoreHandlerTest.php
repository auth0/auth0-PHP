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
    expect($this->transient->getStore())->toEqual($this->store);
});

test('store() assigns data correctly', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    expect($this->store->get($key))->toEqual($value);
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('issue() assigns data correctly', function(string $key): void {
    $value = $this->transient->issue($key);

    expect($this->store->get($key))->toEqual($value);
    expect(mb_strlen($value))->toBeGreaterThanOrEqual(16);
})->with(['random key' => [
    fn() => uniqid(),
]]);

test('getOnce() assigns data correctly and is only retrievable once', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    expect($this->store->get($key))->toEqual($value);
    expect($this->transient->getOnce($key))->toEqual($value);
    expect($this->transient->getOnce($key))->toBeNull();
    expect($this->store->get($key))->toBeNull();
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('verify() correctly verifies data', function(string $key, string $value): void {
    $this->transient->store($key, $value);

    expect($this->transient->verify($key, $value))->toBeTrue();
    expect($this->transient->verify($key, $value))->toBeFalse();
    expect($this->transient->getOnce($key))->toBeNull();
    expect($this->store->get($key))->toBeNull();
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('isset() returns correct state', function(string $key, string $value): void {
    expect($this->transient->isset($key))->toBeFalse();

    $this->transient->store($key, $value);

    expect($this->transient->isset($key))->toBeTrue();

    $this->transient->getOnce($key);

    expect($this->transient->isset($key))->toBeFalse();
})->with(['random data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
