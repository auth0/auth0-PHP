<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;
use Auth0\Tests\Utilities\MockCrypto;
use Auth0\Tests\Utilities\MockDataset;

uses()->group('session', 'cookies');

beforeEach(function(): void {
    $this->namespace = uniqid();
    $this->cookieSecret = uniqid() . bin2hex(random_bytes(32));

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'cookieSecret' => $this->cookieSecret
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $this->exampleKey = uniqid();
});

afterEach(function () {
    $_COOKIE = [];
});

it('hashes the namespace', function(): void {
    $this->assertNotEquals($this->namespace, $this->store->getNamespace());
});

it('calculates a chunking threshold', function(): void {
    $this->assertGreaterThan(0, $this->store->getThreshold());
});

it('populates state from getState() override', function(array $state): void {
    $this->store->getState([$this->exampleKey => $state]);

    $this->assertEquals($state, $this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('populates state from $_COOKIE correctly', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, serialize([$this->exampleKey => $state]));
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    $this->assertEquals($state, $this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('populates state from a chunked $_COOKIE correctly', function(array $state): void {
    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, serialize([$this->exampleKey => $state]));
    $chunks = str_split($encrypted, 32);

    foreach($chunks as $index => $chunk) {
        $_COOKIE[$this->store->getNamespace() . CookieStore::KEY_SEPARATOR . $index] = $chunk;
    }

    $this->store->getState();

    $this->assertEquals($state, $this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('does not populate state from a malformed $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $_COOKIE[$cookieNamespace] = [$this->exampleKey => $state];

    $this->store->getState();

    $this->assertNull($this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('does not populate state from an unencrypted $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $_COOKIE[$cookieNamespace] = json_encode(serialize([$this->exampleKey => $state]));

    $this->store->getState();

    $this->assertNull($this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('set() updates state and $_COOKIE', function(array $states): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $this->store->getState([$this->exampleKey => $states[0]]);
    $this->store->setState();

    $this->assertNotEmpty($_COOKIE);
    $this->assertNotNull($this->store->get($this->exampleKey));
    $this->assertNotNull($_COOKIE[$cookieNamespace]);

    $previousCookieState = $_COOKIE[$cookieNamespace];

    $this->store->set($this->exampleKey, $states[1]);

    $this->assertEquals($states[1], $this->store->get($this->exampleKey));
    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);
})->with(['mocked states' => [
    fn() => [ MockDataset::state(), MockDataset::state() ]
]]);

test('delete() updates state and $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, serialize([$this->exampleKey => $state]));
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    $previousCookieState = $_COOKIE[$cookieNamespace];

    $this->store->setState();

    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);

    $this->store->delete($this->exampleKey);

    $this->assertNull($_COOKIE[$cookieNamespace] ?? null);
    $this->assertNull($this->store->get($this->exampleKey));
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('purge() clears state and $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, serialize([$this->exampleKey => $state]));
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    $this->assertNotEmpty($_COOKIE);
    $this->assertNotNull($this->store->get($this->exampleKey));
    $this->assertNotNull($_COOKIE[$cookieNamespace]);

    $this->store->purge();

    $this->assertNull($_COOKIE[$cookieNamespace] ?? null);
    $this->assertEmpty($_COOKIE);
    $this->assertEmpty($this->store->getState());
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('encrypt() throws an exception if a cookie secret is not configured', function(): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none'
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

    $this->store->set('testing', 'this should throw an error');
});

test('decrypt() throws an exception if a cookie secret is not configured', function(array $state): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none'
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $cookieNamespace = $this->store->getNamespace() . '_0';
    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, serialize([$this->exampleKey => $state]));
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

    $this->store->getState();
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('decrypt() returns null if malformed JSON is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $_COOKIE[$cookieNamespace] = 'nonsense';

    $this->assertEmpty($this->store->getState());
});

test('decrypt() returns null if a malformed cryptographic manifest is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $_COOKIE[$cookieNamespace] = json_encode(serialize([
        'tag' => uniqid()
    ]));

    $this->assertEmpty($this->store->getState());

    $_COOKIE[$cookieNamespace] = json_encode(serialize([
        'iv' => 'hi 👋 malformed cryptographic manifest here',
        'tag' => (string) uniqid()
    ]));

    $this->assertEmpty($this->store->getState());
});

test('decrypt() returns null if a malformed data payload is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $payload = json_encode(serialize([
        'tag' => base64_encode((string) uniqid()),
        'iv' => base64_encode($iv),
        'data' => 'not encrypted :eyes:'
    ]), JSON_THROW_ON_ERROR);

    $_COOKIE[$cookieNamespace] = $payload;

    $this->assertEmpty($this->store->getState());
});
