<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\SDK\Token\Verifier;
use Auth0\Tests\Utilities\TokenGenerator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

// uses()->group('token', 'token.verifier');

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
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ALG_HEADER);

    new Verifier($this->configuration, '', '', []);
});

test('verify() throws an error when token alg claim conflicts with expected algorithm', function(): void {
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_UNEXPECTED_SIGNING_ALGORITHM, 'RS256', 'HS256'));

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_HS256], Token::ALGO_RS256);
});

test('verify() throws an error when token alg claim is not supported', function(): void {
    $randomAlg = uniqid();

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_UNSUPPORTED_SIGNING_ALGORITHM, $randomAlg));

    new Verifier($this->configuration, '', '', ['alg' => $randomAlg]);
});

// RS256-specific tests:

test('[RS256] verify() throws an error when token kid claim is missing', function(): void {
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_KID_HEADER);

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256]);
});

test('[RS256] getKeySet() throws an error when jwks uri is not configured', function(): void {
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_REQUIRES_JWKS_URI);

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => uniqid()]);
});

test('[RS256] getKeySet() throws an error when jwks uri is not reachable', function($jwksUri): void {
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => uniqid()], null, $jwksUri);
})->with('jwksUri');

test('[RS256] getKeySet() does not make a network request when there are matching cached results', function($jwksUri, $jwksCacheKey): void {
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => ['123']]]);
    $cache->save($item);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

    // This would throw a ConnectException rather than a InvalidTokenException if a network request was made.
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__test_kid__'], null, $jwksUri, null, null, $cache);
})->with('jwksUri');

test('[RS256] getKeySet() invalidates cache when expected key is missing', function($jwksUri, $jwksCacheKey): void {
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => ['123']]]);
    $cache->save($item);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);

    // As '__missing_kid__' isn't in the cache, it will attempt to make a network request, which raises a ConnectException since we aren't using a real JWKS endpoint.
    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_RS256, 'kid' => '__missing_kid__'], null, $jwksUri, null, null, $cache);
})->with('jwksUri');

test('[RS256] verify() succeeds when signing key is correct', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    $headers = TokenGenerator::decodePart($headers);
    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => [$keyPair['cert']]]]);
    $cache->save($item);

    $this->assertIsObject(new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_RS256, $jwksUri, null, null, $cache));
})->with('tokenRs256');

test('[RS256] verify() throws an error when signing key is wrong', function($keyPair, $token, $payload, $signature, $headers, $jwksUri, $jwksCacheKey): void {
    $headers = TokenGenerator::decodePart($headers);

    $differentKeyPair = TokenGenerator::generateRsaKeyPair();

    $cache = new ArrayAdapter();
    $item = $cache->getItem($jwksCacheKey);
    $item->set(['__test_kid__' => ['x5c' => [$differentKeyPair['cert']]]]);
    $cache->save($item);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

    new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_RS256, $jwksUri, null, null, $cache);
})->with('tokenRs256');

// HS256-specific tests:

test('[HS256] verify() throws an error when client secret is not configured', function(): void {
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_REQUIRES_CLIENT_SECRET);

    new Verifier($this->configuration, '', '', ['alg' => Token::ALGO_HS256], Token::ALGO_HS256);
});

test('[HS256] verify() throws an error when secret is wrong', function($token, $payload, $signature, $headers): void {
    $headers = TokenGenerator::decodePart($headers);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

    new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_HS256, null, '__a_different_secret__');
})->with('tokenHs256');

test('[HS256] verify() succeeds when secret is correct', function($token, $payload, $signature, $headers): void {
    $headers = TokenGenerator::decodePart($headers);
    $this->assertIsObject(new Verifier($this->configuration, $payload, $signature, $headers, Token::ALGO_HS256, null, '__test_client_secret__'));
})->with('tokenHs256');
