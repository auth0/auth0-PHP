<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;

uses()->group('storage', 'storage.cookie');

beforeEach(function(): void {
    $_COOKIE = [];

    $this->configuration = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientSecret' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    $this->namespace = uniqid();

    $this->store = new CookieStore($this->configuration, $this->namespace);
});

test('set() assigns values as expected', function(string $key, string $value): void {
    $cookieCount = count($_COOKIE);

    $this->store->set($key, $value);
    $this->assertEquals($cookieCount + 1, count($_COOKIE));
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

test('get() retrieves a default value as expected', function(string $key): void {
    $this->assertEquals('foobar', $this->store->get($key, 'foobar'));
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
    $cookieCount = count($_COOKIE);

    $this->store->set($key, $value);
    $this->assertEquals($cookieCount + 1, count($_COOKIE));

    $this->store->delete($key);
    $this->assertEquals($cookieCount, count($_COOKIE));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('deleteAll() clears values as expected', function(string $key, string $value): void {
    $cookieCount = count($_COOKIE);

    $this->store->set($key, $value);
    $this->assertEquals($cookieCount + 1, count($_COOKIE));

    $this->store->deleteAll();
    $this->assertNull($this->store->get($key));
    $this->assertEquals($cookieCount, count($_COOKIE));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
