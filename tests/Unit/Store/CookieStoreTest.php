<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;

uses()->group('session', 'cookies');

it('throws an exception if no cookie secret is configured', function(): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none'
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

    $this->store->set('testing', 'this should throw an error');
});

beforeEach(function(): void {
    $_COOKIE = [];

    $this->namespace = uniqid();
    $this->cookieSecret = uniqid() . bin2hex(random_bytes(32));

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'cookieSecret' => $this->cookieSecret
    ]);

    $this->store = new CookieStore($this->configuration, $this->namespace);
});

it('hashes the namespace', function(): void {
    $this->assertNotEquals($this->namespace, $this->store->getNamespace());
});

it('calculates a chunking threshold', function(): void {
    $this->assertGreaterThan(0, $this->store->getThreshold());
});

it('populates state from getState() override', function(): void {
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $this->store->getState($mock);

    $this->assertEquals($mock[$mockKey], $this->store->get($mockKey));
});

it('populates state from $_COOKIE correctly', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encrypted = openssl_encrypt(serialize($mock), CookieStore::VAL_CRYPTO_ALGO, $this->cookieSecret, 0, $iv, $tag);
    $stored = base64_encode(json_encode(serialize([
        'tag' => base64_encode($tag),
        'iv' => base64_encode($iv),
        'data' => $encrypted
    ]), JSON_THROW_ON_ERROR));

    $_COOKIE[$cookieNamespace] = $stored;

    $this->store->getState();

    $this->assertEquals($mock[$mockKey], $this->store->get($mockKey));
});

it('populates state from a chunked $_COOKIE correctly', function(): void {
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encrypted = openssl_encrypt(serialize($mock), CookieStore::VAL_CRYPTO_ALGO, $this->cookieSecret, 0, $iv, $tag);
    $stored = base64_encode(json_encode(serialize([
        'tag' => base64_encode($tag),
        'iv' => base64_encode($iv),
        'data' => $encrypted
    ]), JSON_THROW_ON_ERROR));

    $chunks = str_split($stored, 32);

    foreach($chunks as $index => $chunk) {
        $_COOKIE[$this->store->getNamespace() . CookieStore::KEY_SEPARATOR . $index] = $chunk;
    }

    $this->store->getState();

    $this->assertEquals($mock[$mockKey], $this->store->get($mockKey));
});

it('does not populate state from a malformed $_COOKIE', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $_COOKIE[$cookieNamespace] = $mock;

    $this->store->getState();

    $this->assertNull($this->store->get($mockKey));
});

it('does not populate state from an unencrypted $_COOKIE', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $_COOKIE[$cookieNamespace] = json_encode(serialize($mock));

    $this->store->getState();

    $this->assertNull($this->store->get($mockKey));
});

test('set() updates state and $_COOKIE', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $this->store->getState($mock);
    $this->store->setState();

    $this->assertNotEmpty($_COOKIE);
    $this->assertNotNull($this->store->get($mockKey));
    $this->assertNotNull($_COOKIE[$cookieNamespace]);

    $previousCookieState = $_COOKIE[$cookieNamespace];

    $mock[$mockKey]['bool'] = false;
    $mock[$mockKey]['test'] = 123;

    $this->store->set($mockKey, $mock[$mockKey]);

    $this->assertEquals($mock[$mockKey], $this->store->get($mockKey));
    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);
});

test('delete() updates state and $_COOKIE', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encrypted = openssl_encrypt(serialize($mock), CookieStore::VAL_CRYPTO_ALGO, $this->cookieSecret, 0, $iv, $tag);
    $stored = base64_encode(json_encode(serialize([
        'tag' => base64_encode($tag),
        'iv' => base64_encode($iv),
        'data' => $encrypted
    ]), JSON_THROW_ON_ERROR));

    $_COOKIE[$cookieNamespace] = $stored;

    $this->store->getState();

    $previousCookieState = $_COOKIE[$cookieNamespace];

    $this->store->setState();

    $this->assertNotEquals($_COOKIE[$cookieNamespace], $previousCookieState);

    $this->store->delete($mockKey);

    $this->assertNull($_COOKIE[$cookieNamespace] ?? null);
    $this->assertNull($this->store->get($mockKey));
});

test('purge() clears state and $_COOKIE', function(): void {
    $cookieNamespace = $this->store->getNamespace() . '_0';
    $mockKey = uniqid();

    $mock = [
        "$mockKey" => [
            'bool' => true,
            'null' => null,
            'array' => [
                'testing',
            ],
            'object' => [
                'a' => 1,
                'b' => '2',
                'c' => 'test',
            ],
        ],
    ];

    $ivLength = openssl_cipher_iv_length(CookieStore::VAL_CRYPTO_ALGO);
    $iv = openssl_random_pseudo_bytes($ivLength);
    $encrypted = openssl_encrypt(serialize($mock), CookieStore::VAL_CRYPTO_ALGO, $this->cookieSecret, 0, $iv, $tag);
    $stored = base64_encode(json_encode(serialize([
        'tag' => base64_encode($tag),
        'iv' => base64_encode($iv),
        'data' => $encrypted
    ]), JSON_THROW_ON_ERROR));

    $_COOKIE[$cookieNamespace] = $stored;

    $this->store->getState();

    $this->assertNotEmpty($_COOKIE);
    $this->assertNotNull($this->store->get($mockKey));
    $this->assertNotNull($_COOKIE[$cookieNamespace]);

    $this->store->purge();

    $this->assertNull($_COOKIE[$cookieNamespace] ?? null);
    $this->assertEmpty($_COOKIE);
    $this->assertEmpty($this->store->getState());
});
