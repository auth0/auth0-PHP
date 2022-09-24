<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;
use Auth0\Tests\Utilities\MockCrypto;
use Auth0\Tests\Utilities\MockDataset;

uses()->group('storage', 'storage.cookies');

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

it('calculates a chunking threshold', function(): void {
    expect($this->store->getThreshold())->toBeGreaterThan(0);
});

it('populates state from getState() override', function(array $state): void {
    $this->store->getState([$this->exampleKey => $state]);

    expect($this->store->get($this->exampleKey))->toEqual($state);
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('populates state from $_COOKIE correctly', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, [$this->exampleKey => $state]);

    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    expect($this->store->get($this->exampleKey))->toEqual($state);
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('populates state from a chunked $_COOKIE correctly', function(array $state): void {
    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, [$this->exampleKey => $state]);
    $chunks = str_split($encrypted, 32);

    foreach($chunks as $index => $chunk) {
        $_COOKIE[$this->store->getNamespace() . CookieStore::KEY_SEPARATOR . $index] = $chunk;
    }

    $this->store->getState();

    expect($this->store->get($this->exampleKey))->toEqual($state);
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('does not populate state from a malformed $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $_COOKIE[$cookieNamespace] = [$this->exampleKey => $state];

    $this->store->getState();

    expect($this->store->get($this->exampleKey))->toBeNull();
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

it('does not populate state from an unencrypted $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $_COOKIE[$cookieNamespace] = json_encode([$this->exampleKey => $state]);

    $this->store->getState();

    expect($this->store->get($this->exampleKey))->toBeNull();
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

    expect($this->store->get($this->exampleKey))->toEqual($states[1]);
    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);
})->with(['mocked states' => [
    fn() => [ MockDataset::state(), MockDataset::state() ]
]]);

test('delete() updates state and $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, [$this->exampleKey => $state]);
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    $previousCookieState = $_COOKIE[$cookieNamespace];

    // Force the state change. As we didn't use the class methods to mutate the session state, it won't be flagged as dirty internally.
    $this->store->setState(true);

    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);

    $this->store->delete($this->exampleKey);

    expect($_COOKIE[$cookieNamespace] ?? null)->toBeNull();
    expect($this->store->get($this->exampleKey))->toBeNull();
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('purge() clears state and $_COOKIE', function(array $state): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, [$this->exampleKey => $state]);
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();

    $this->assertNotEmpty($_COOKIE);
    $this->assertNotNull($this->store->get($this->exampleKey));
    $this->assertNotNull($_COOKIE[$cookieNamespace]);

    $this->store->purge();

    expect($_COOKIE[$cookieNamespace] ?? null)->toBeNull();
    expect($_COOKIE)->toBeEmpty();
    expect($this->store->getState())->toBeEmpty();
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('encrypt() throws an exception if a cookie secret is not configured', function(): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none'
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $this->store->set('testing', 'this should throw an error');
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

test('decrypt() throws an exception if a cookie secret is not configured', function(array $state): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none'
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $cookieNamespace = $this->store->getNamespace() . '_0';
    $encrypted = MockCrypto::cookieCompatibleEncrypt($this->cookieSecret, [$this->exampleKey => $state]);
    $_COOKIE[$cookieNamespace] = $encrypted;

    $this->store->getState();
})->with(['mocked state' => [
    fn() => MockDataset::state()
]])->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

test('decrypt() returns null if malformed JSON is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $_COOKIE[$cookieNamespace] = 'nonsense';

    expect($this->store->getState())->toBeEmpty();
});

test('decrypt() returns null if a malformed cryptographic manifest is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $_COOKIE[$cookieNamespace] = json_encode([
        'tag' => uniqid()
    ]);

    expect($this->store->getState())->toBeEmpty();

    $_COOKIE[$cookieNamespace] = json_encode([
        'iv' => 'hi 👋 malformed cryptographic manifest here',
        'tag' => (string) uniqid()
    ]);

    expect($this->store->getState())->toBeEmpty();
});

test('decrypt() returns null if a malformed data payload is encoded', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $payload = json_encode([
        'tag' => base64_encode((string) uniqid()),
        'iv' => base64_encode($iv),
        'data' => 'not encrypted :eyes:'
    ], JSON_THROW_ON_ERROR);

    $_COOKIE[$cookieNamespace] = $payload;

    expect($this->store->getState())->toBeEmpty();
});

test('configured SameSite() is reflected', function(): void {
    $this->configuration->setCookieSameSite('strict');

    $options = $this->store->getCookieOptions();

    expect($options['samesite'])->toEqual('strict');
});

test('unsupported configured SameSite() is overwritten by default of `lax`', function(): void {
    $this->configuration->setCookieSameSite('testing');

    $options = $this->store->getCookieOptions();

    expect($options['samesite'])->toEqual('Lax');
});

test('toggling encryption works', function(array $state): void {
    expect($this->store->getEncrypted())->toEqual(true);

    $this->store->setEncrypted(false);
    expect($this->store->getEncrypted())->toEqual(false);

    $encrypted = $this->store->encrypt($state);
    expect($encrypted)->toEqual(rawurlencode(json_encode($state)));
    expect($this->store->decrypt($encrypted))->toEqual($state);
    expect($this->store->decrypt(rawurlencode(json_encode('test'))))->toEqual([]);
})->with(['mocked state' => [
    fn() => MockDataset::state()
]]);

test('encrypt() returns nothing with invalid crypto properties', function(): void {
    $state = MockDataset::state();

    expect($this->store->encrypt($state, ['ivLen' => false]))->toEqual('');
    expect($this->store->encrypt($state, ['iv' => false]))->toEqual('');
    expect($this->store->encrypt($state, ['tag' => false]))->toEqual('');
    expect($this->store->encrypt($state, ['encrypted' => false]))->toEqual('');
    expect($this->store->encrypt($state, ['encoded1' => false]))->toEqual('');
    expect($this->store->encrypt($state, ['encoded2' => false]))->toEqual('');

    $this->store->setEncrypted(false);
    expect($this->store->encrypt($state, ['encoded1' => false]))->toEqual('');
});
