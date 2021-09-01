<?php

declare(strict_types=1);

use Auth0\SDK\Store\MemoryStore;

uses()->group('storage', 'storage.memory');

beforeEach(function(): void {
    $this->store = new MemoryStore();
});

test('set() assigns values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    expect($this->store->get($key))->toEqual($value);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    expect($this->store->get($key, 'foobar'))->toEqual($value);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves default values as expected', function(string $key): void {
    expect($this->store->get($key, 'foobar'))->toEqual('foobar');
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
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
