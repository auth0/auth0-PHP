<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\SessionStore;

uses()->group('storage', 'storage.session');

beforeEach(function(): void {
    $_SESSION = [];

    $this->configuration = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientSecret' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    $this->namespace = uniqid();

    $this->store = new SessionStore($this->configuration, $this->namespace);
});

test('set() assigns values as expected', function(string $key, string $value): void {
    $this->store->set($key, $value);
    $this->assertEquals($value, $_SESSION[$this->namespace . '_' . $key]);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves values as expected', function(string $key, string $value): void {
    $_SESSION[$this->namespace . '_' . $key] = $value;
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
    $_SESSION[$this->namespace . '_' . $key] = $value;
    $this->assertTrue(isset($_SESSION[$this->namespace . '_' . $key]));

    $this->store->delete($key);

    $this->assertNull($this->store->get($key));
    $this->assertFalse(isset($_SESSION[$this->namespace . '_' . $key]));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('deleteAll() clears values as expected', function(string $key, string $value): void {
    $_SESSION[$this->namespace . '_' . $key] = $value;
    $this->assertTrue(isset($_SESSION[$this->namespace . '_' . $key]));

    $this->store->deleteAll();

    $this->assertNull($this->store->get($key));
    $this->assertFalse(isset($_SESSION[$this->namespace . '_' . $key]));
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
