<?php

declare(strict_types=1);

use Auth0\SDK\Token\Generator;
use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use Auth0\Tests\Utilities\Chaos;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('token', 'token.generator');

it('throws an error when instantiated directly', function(): void {
    new Generator(uniqid());
})->throws(Error::class);

it('throws an error when a signing key is provided as a string with RS256', function(): void {
    Generator::create(uniqid());
})->throws(TokenException::class);

it('throws an error when an incompatible signing key is used with RS256', function(): void {
    $mockSigningKey = TokenGenerator::generateDsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['private']
    );
})->throws(TokenException::class);

it('throws an error when an incompatible signing key is used with HS256', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_HS256
    );
})->throws(TokenException::class);

it('throws an error when an malformed signing key is used with RS256', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair()['private'];

    for ($i = 0; $i < 128; $i++) {
        $corruptedSigningKey = Chaos::corruptString($mockSigningKey, random_int(0, 256));

        Generator::create(
            signingKey: $corruptedSigningKey
        );
    }
})->throws(TokenException::class);

it('throws an error when an incompatible algorithm is specified', function(): void {
    Generator::create(
        signingKey: uniqid(),
        algorithm: uniqid()
    );
})->throws(TokenException::class);

it('throws an error when too small a bit length is used by a configured signing key', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair(
        bitLength: 1024 / 2
    );

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_RS256
    );
})->throws(TokenException::class);

it('throws an error when too large bit length is used by a configured signing key', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair(
        bitLength: 1024 * 5
    );

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_RS256
    );
})->throws(TokenException::class);

it('returns an instance of the Generator class', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    );

    expect($token)->toBeInstanceOf(Generator::class);
});

test('toArray(false) returns the segments as a key pair with a valid RS256 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid RS256 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid RS256 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid RS256 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private']
    );

    expect($token)->toBeString();
});

test('toArray(false) returns the segments as a key pair with a valid HS256 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS256
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid HS256 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS256
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid HS256 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS256
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid HS256 configuration', function(): void {
    $token = (string) Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS256
    );

    expect($token)->toBeString();
});

it('assigns a correct `type` header value', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['type'])
        ->headers->type->toBeString()->toEqual('JWT');

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'type' => null
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['type'])
        ->headers->type->toBeString()->toEqual('JWT');

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'type' => uniqid()
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['type'])
        ->headers->type->toBeString()->toEqual('JWT');
});

it('assigns the correct `alg` header value', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature'])
        ->headers->toBeArray()->toHaveKeys(['alg'])
        ->headers->alg->toBeString()->toEqual(Token::ALGO_RS256);

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'alg' => Token::ALGO_HS256
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature'])
        ->headers->toBeArray()->toHaveKeys(['alg'])
        ->headers->alg->toBeString()->toEqual(Token::ALGO_RS256);

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'alg' => 'none'
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature'])
        ->headers->toBeArray()->toHaveKeys(['alg'])
        ->headers->alg->toBeString()->toEqual(Token::ALGO_RS256);

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'alg' => 'none'
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature'])
        ->headers->toBeArray()->toHaveKeys(['alg'])
        ->headers->alg->toBeString()->toEqual(Token::ALGO_RS256);
});
