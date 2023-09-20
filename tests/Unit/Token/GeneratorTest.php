<?php

declare(strict_types=1);

use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use Auth0\SDK\Token\Generator;
use Auth0\Tests\Utilities\Chaos;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('token', 'token.generator');

it('throws an error when instantiated directly', function(): void {
    new Generator(uniqid());
})->throws(Error::class);

it('throws an error when an incompatible algorithm is specified', function(): void {
    Generator::create(
        signingKey: uniqid(),
        algorithm: uniqid()
    );
})->throws(TokenException::class);

it('returns an instance of the Generator class', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    );

    expect($token)->toBeInstanceOf(Generator::class);
});

/**
 * HS256 tests.
 */

it('throws an error when an incompatible signing key is used with HS256', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_HS256
    );
})->throws(TokenException::class);

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
    $key = uniqid();

    $token = (string) Generator::create(
        signingKey: $key,
        algorithm: TOKEN::ALGO_HS256
    );

    expect($token)->toBeString();

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);

    $hash = hash_hmac('sha256', $payload, $key, true);
    $hash = str_replace(search: '=', replace: '', subject: strtr(base64_encode($hash), '+/', '-_'));
    $valid = hash_equals($hash, $signature);

    expect($valid)->toBeTrue();
});

test('a valid signature is produced for HS256 configurations', function(): void {
    $key = uniqid();

    $token = (string) Generator::create(
        signingKey: $key,
        algorithm: TOKEN::ALGO_HS256
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);

    $hash = hash_hmac('sha256', $payload, $key, true);
    $hash = str_replace(search: '=', replace: '', subject: strtr(base64_encode($hash), '+/', '-_'));
    $valid = hash_equals($hash, $signature);

    expect($valid)->toBeTrue();
});

/**
 * HS384 tests.
 */

 it('throws an error when an incompatible signing key is used with HS384', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_HS384
    );
})->throws(TokenException::class);

test('toArray(false) returns the segments as a key pair with a valid HS384 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS384
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid HS384 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS384
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid HS384 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS384
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid HS384 configuration', function(): void {
    $token = (string) Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS384
    );

    expect($token)->toBeString();
});

test('a valid signature is produced for HS384 configurations', function(): void {
    $key = uniqid();

    $token = (string) Generator::create(
        signingKey: $key,
        algorithm: TOKEN::ALGO_HS384
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);

    $hash = hash_hmac('sha384', $payload, $key, true);
    $hash = str_replace(search: '=', replace: '', subject: strtr(base64_encode($hash), '+/', '-_'));
    $valid = hash_equals($hash, $signature);

    expect($valid)->toBeTrue();
});

/**
 * HS512 tests.
 */

 it('throws an error when an incompatible signing key is used with HS512', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['resource'],
        algorithm: Token::ALGO_HS512
    );
})->throws(TokenException::class);

test('toArray(false) returns the segments as a key pair with a valid HS512 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS512
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid HS512 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS512
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid HS512 configuration', function(): void {
    $token = Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS512
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid HS512 configuration', function(): void {
    $token = (string) Generator::create(
        signingKey: uniqid(),
        algorithm: TOKEN::ALGO_HS512
    );

    expect($token)->toBeString();
});

test('a valid signature is produced for HS512 configurations', function(): void {
    $key = uniqid();

    $token = (string) Generator::create(
        signingKey: $key,
        algorithm: TOKEN::ALGO_HS512
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);

    $hash = hash_hmac('sha512', $payload, $key, true);
    $hash = str_replace(search: '=', replace: '', subject: strtr(base64_encode($hash), '+/', '-_'));
    $valid = hash_equals($hash, $signature);

    expect($valid)->toBeTrue();
});

/**
 * RS256 tests.
 */

it('throws an error when a signing key is provided as a string with RS256', function(): void {
    Generator::create(uniqid());
})->throws(TokenException::class);

it('throws an error when an incompatible signing key is used with RS256', function(): void {
    $mockSigningKey = TokenGenerator::generateDsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['private']
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

test('a valid signature is produced for RS256 configurations', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private'],
        algorithm: TOKEN::ALGO_RS256
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);
    $signature = base64_decode(strtr($signature, '-_', '+/'), true);

    $valid = openssl_verify($payload, $signature, $mockSigningKey['public'], OPENSSL_ALGO_SHA256);

    expect($valid)->toEqual(1);
});

/**
 * RS384 tests.
 */

 it('throws an error when a signing key is provided as a string with RS384', function(): void {
    Generator::create(uniqid());
})->throws(TokenException::class);

it('throws an error when an incompatible signing key is used with RS384', function(): void {
    $mockSigningKey = TokenGenerator::generateDsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['private']
    );
})->throws(TokenException::class);

it('throws an error when an malformed signing key is used with RS384', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair()['private'];

    for ($i = 0; $i < 128; $i++) {
        $corruptedSigningKey = Chaos::corruptString($mockSigningKey, random_int(0, 384));

        Generator::create(
            signingKey: $corruptedSigningKey
        );
    }
})->throws(TokenException::class);

test('toArray(false) returns the segments as a key pair with a valid RS384 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid RS384 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid RS384 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid RS384 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private']
    );

    expect($token)->toBeString();
});

test('a valid signature is produced for RS384 configurations', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private'],
        algorithm: TOKEN::ALGO_RS384
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);
    $signature = base64_decode(strtr($signature, '-_', '+/'), true);

    $valid = openssl_verify($payload, $signature, $mockSigningKey['public'], OPENSSL_ALGO_SHA384);

    expect($valid)->toEqual(1);
});

/**
 * RS512 tests.
 */

 it('throws an error when a signing key is provided as a string with RS512', function(): void {
    Generator::create(uniqid());
})->throws(TokenException::class);

it('throws an error when an incompatible signing key is used with RS512', function(): void {
    $mockSigningKey = TokenGenerator::generateDsaKeyPair();

    Generator::create(
        signingKey: $mockSigningKey['private']
    );
})->throws(TokenException::class);

it('throws an error when an malformed signing key is used with RS512', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair()['private'];

    for ($i = 0; $i < 128; $i++) {
        $corruptedSigningKey = Chaos::corruptString($mockSigningKey, random_int(0, 512));

        Generator::create(
            signingKey: $corruptedSigningKey
        );
    }
})->throws(TokenException::class);

test('toArray(false) returns the segments as a key pair with a valid RS512 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toArray(true) returns the segments without keys with a valid RS512 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray();

    expect($token)
        ->toBeArray()
        ->toHaveCount(3)
        ->not()->toHaveKeys(['headers', 'claims', 'signature']);
});

test('toString() returns the segments formatted as a string with a valid RS512 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toString();

    expect($token)->toBeString();
});

test('type casting a Generator to a string returns the segments formatted as a string with a valid RS512 configuration', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private']
    );

    expect($token)->toBeString();
});

test('a valid signature is produced for RS512 configurations', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = (string) Generator::create(
        signingKey: $mockSigningKey['private'],
        algorithm: TOKEN::ALGO_RS512
    );

    [$headers, $claims, $signature] = explode('.', $token);
    $payload = implode('.', [$headers, $claims]);
    $signature = base64_decode(strtr($signature, '-_', '+/'), true);

    $valid = openssl_verify($payload, $signature, $mockSigningKey['public'], OPENSSL_ALGO_SHA512);

    expect($valid)->toEqual(1);
});

/**
 * Header tests.
 */

it('assigns a correct `type` header value', function(): void {
    $mockSigningKey = TokenGenerator::generateRsaKeyPair();

    $token = Generator::create(
        signingKey: $mockSigningKey['private']
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['typ'])
        ->headers->typ->toBeString()->toEqual('JWT');

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'typ' => null
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['typ'])
        ->headers->type->toBeString()->toEqual('JWT');

    $token = Generator::create(
        signingKey: $mockSigningKey['private'],
        headers: [
            'typ' => uniqid()
        ]
    )->toArray(false);

    expect($token)
        ->toBeArray()->toHaveKeys(['headers'])
        ->headers->toBeArray()->toHaveKeys(['typ'])
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
