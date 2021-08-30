<?php

declare(strict_types=1);

use Auth0\SDK\Store\InMemoryStorage;

uses()->group('storage', 'storage.in_memory');

beforeEach(function(): void {
    $this->store = new InMemoryStorage();
});

test('set() assigns values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    $this->assertEquals($value, $this->store->get($key));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    $this->assertEquals($value, $this->store->get($key, 'foobar'));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves default values as expected', function(string $key): void {
    $this->assertEquals('foobar', $this->store->get($key, 'foobar'));
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
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
