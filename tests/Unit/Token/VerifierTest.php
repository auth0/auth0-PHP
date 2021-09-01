<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\SDK\Token\Verifier;
use Auth0\Tests\Utilities\TokenGenerator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('token', 'token.verifier');

beforeEach(function() {
    $this->configuration = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'cookieSecret' => uniqid(),
        'redirectUri' => uniqid(),
    ]);
});

dataset('jwksUri', static function () {
    yield [ 'https://test.auth0.com/.well-known/jwks.json', hash('sha256', 'https://test.auth0.com/.well-known/jwks.json') ];
});

dataset('tokenHs256', static function () {
    $token = (new TokenGenerator())->withHs256([]);
    [$headers, $claims, $signature] = explode('.', $token);
    $payload = join('.', [$headers, $claims]);
    $signature = TokenGenerator::decodePart($signature, false);

    yield [ $token, $payload, $signature, $headers ];
});

dataset('tokenRs256', static function () {
    $keyPair = TokenGenerator::generateRsaKeyPair();
    $token = (new TokenGenerator())->withRs256([], $keyPair['private'], ['kid' => '__test_kid__']);
    [$headers, $claims, $signature] = explode('.', $token);
    $payload = join('.', [$headers, $claims]);
    $signature = TokenGenerator::decodePart($signature, false);

    // Mimic JWKS response format: strip opening and closing comment lines from public key, remove line breaks.
    $keyPair['cert'] = trim(mb_substr($keyPair['cert'], strpos($keyPair['cert'], "\n")+1));
    $keyPair['cert'] = str_replace("\n", '', mb_substr($keyPair['cert'], 0, strrpos($keyPair['cert'], "\n")));

    yield [ $keyPair, $token, $payload, $signature, $headers, 'https://test.auth0.com/.well-known/jwks.json', hash('sha256', 'https://test.auth0.com/.well-known/jwks.json') ];
});

test('verify() throws an error when token alg claim is missing', function(): void {
    new Verifier($this->configuration, '', '', []);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ALG_HEADER);

test('verify() throws an error when token alg claim conflicts with expected algorithm', function(): void {
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_HS256], Token::ALGO_RS256);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_UNEXPECTED_SIGNING_ALGORITHM, 'RS256', 'HS256'));

test('verify() throws an error when token alg claim is not supported', function(): void {
    new Verifier($this->configuration, '', '', ['alg' => uniqid()]);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('verify() throws an exception signature is incorrect', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    $headers = TokenGenerator::decodePart($headers);
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => [$keyPair['cert']]]]);
    $cache->save($item);

    new Verifier($this->configuration, $payload, uniqid(), $headers, Token::ALGO_RS256, $jwksUri, null, null, $cache);
})->with('tokenRs256')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

// RS256-specific tests:

test('[RS256] verify() throws an error when token kid claim is missing', function(): void {
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256]);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_KID_HEADER);

test('[RS256] getKeySet() throws an error when jwks uri is not configured', function(): void {
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => uniqid()]);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_REQUIRES_JWKS_URI);

test('[RS256] getKeySet() throws an error when jwks uri is not reachable', function($jwksUri): void {
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => uniqid()], null, $jwksUri);
})->with('jwksUri')->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('[RS256] getKeySet() throws an error when jwks uri is not a valid url', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    new Verifier($this->configuration, $payload, $signature, TokenGenerator::decodePart($headers, true), Token::ALGO_RS256, ':', null, null);
})->with('tokenRs256')->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('[RS256] getKeySet() makes a network request to fetch JWKS and caches the result', function($jwksUri, $jwksCacheKey): void {
    $cache = new ArrayAdapter();

    $httpResponses = [
        (object) ['response' => \Auth0\Tests\Utilities\HttpResponseGenerator::create(json_encode([
            'keys' => [
                (object) [
                    'alg' => 'RS256',
                    'kty' => 'RSA',
                    'use' => 'sig',
                    'n' => uniqid(),
                    'e' => uniqid(),
                    'kid' => uniqid(),
                    'x5t' => uniqid(),
                    'x5c' => [
                        uniqid()
                    ]
                ]
            ]
        ])), 'callback' => null, 'exception' => null],
    ];

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__test_kid__'], null, $jwksUri, null, null, $cache, $httpResponses);
})->with('jwksUri')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE_MISSING_KID);

test('[RS256] getKeySet() throws an exception if an incompatible signing algorithm is returned from the JWKS payload', function($jwksUri, $jwksCacheKey): void {
    $differentKeyPair = TokenGenerator::generateDsaKeyPair();

    $httpResponses = [
        (object) ['response' => \Auth0\Tests\Utilities\HttpResponseGenerator::create(json_encode([
            'keys' => [
                (object) [
                    'alg' => 'RS256',
                    'kty' => 'RSA',
                    'use' => 'sig',
                    'n' => uniqid(),
                    'e' => uniqid(),
                    'kid' => '__test_kid_1234__',
                    'x5t' => uniqid(),
                    'x5c' => [
                        str_replace(['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----', "\n"], '', $differentKeyPair['cert'])
                    ]
                ]
            ]
        ])), 'callback' => null, 'exception' => null],
    ];

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__test_kid_1234__'], null, $jwksUri, null, null, null, $httpResponses);
})->with('jwksUri')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE_INCOMPATIBLE_ALGORITHM);

test('[RS256] getKeySet() does not make a network request when there are matching cached results', function($jwksUri, $jwksCacheKey): void {
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => ['123']]]);
    $cache->save($item);

    // This would throw a ConnectException rather than a InvalidTokenException if a network request was made.
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__test_kid__'], null, $jwksUri, null, null, $cache);
})->with('jwksUri')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

test('[RS256] getKeySet() invalidates cache when expected key is missing', function($jwksUri, $jwksCacheKey): void {
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => ['123']]]);
    $cache->save($item);

    // As '__missing_kid__' isn't in the cache, it will attempt to make a network request, which raises a ConnectException since we aren't using a real JWKS endpoint.
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__missing_kid__'], null, $jwksUri, null, null, $cache);
})->with('jwksUri')->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('[RS256] verify() succeeds when signing key is correct', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    $headers = TokenGenerator::decodePart($headers);
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => [$keyPair['cert']]]]);
    $cache->save($item);

    expect(new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_RS256, $jwksUri, null, null, $cache))->toBeObject();
})->with('tokenRs256');

test('[RS256] verify() throws an error when signing key is wrong', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    $headers = TokenGenerator::decodePart($headers);

    $differentKeyPair = TokenGenerator::generateRsaKeyPair();

    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => [$differentKeyPair['cert']]]]);
    $cache->save($item);

    new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_RS256, $jwksUri, null, null, $cache);
})->with('tokenRs256')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

// HS256-specific tests:

test('[HS256] verify() throws an error when client secret is not configured', function(): void {
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_HS256], Token::ALGO_HS256);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_REQUIRES_CLIENT_SECRET);

test('[HS256] verify() throws an error when secret is wrong', function($token, $payload, $signature, $headers): void {
    $headers = TokenGenerator::decodePart($headers);

    new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_HS256, null, '__a_different_secret__');
})->with('tokenHs256')->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

test('[HS256] verify() succeeds when secret is correct', function($token, $payload, $signature, $headers): void {
    $headers = TokenGenerator::decodePart($headers);
    expect(new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_HS256, null, '__test_client_secret__'))->toBeObject();
})->with('tokenHs256');
