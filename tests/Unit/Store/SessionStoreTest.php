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
    expect($_SESSION[$this->namespace . '_' . $key])->toEqual($value);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves values as expected', function(string $key, string $value): void {
    $_SESSION[$this->namespace . '_' . $key] = $value;
    expect($this->store->get($key, 'foobar'))->toEqual($value);
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('get() retrieves a default value as expected', function(string $key): void {
    expect($this->store->get($key, 'foobar'))->toEqual('foobar');
})->with(['mocked key' => [
    fn() => uniqid(),
]]);

test('delete() clears values as expected', function(string $key, string $value): void {
    $_SESSION[$this->namespace . '_' . $key] = $value;
    expect(isset($_SESSION[$this->namespace . '_' . $key]))->toBeTrue();

    $this->store->delete($key);

    expect($this->store->get($key))->toBeNull();
    expect(isset($_SESSION[$this->namespace . '_' . $key]))->toBeFalse();
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('purge() clears values as expected', function(string $key, string $value): void {
    $_SESSION[$this->namespace . '_' . $key] = $value;
    expect(isset($_SESSION[$this->namespace . '_' . $key]))->toBeTrue();

    $this->store->purge();

    expect($this->store->get($key))->toBeNull();
    expect(isset($_SESSION[$this->namespace . '_' . $key]))->toBeFalse();
})->with(['mocked data' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);
