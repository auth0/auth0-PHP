<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token\Parser;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('token', 'token.parser');

beforeEach(function() {
    $this->cache = new ArrayAdapter();

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'tokenCache' => $this->cache
    ]);
});

it('throws an exception with malformed token separators', function(
    SdkConfiguration $configuration
): void {
    $jwt = uniqid() . uniqid();

    $token = new Parser($jwt, $configuration);
})->with(['mocked configured' => [
    fn() => $this->configuration
]])->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SEPARATORS);

it('accepts and successfully parses a valid RS256 ID Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Parser($jwt->token, $configuration);

    expect($token)
        ->toBeObject()
        ->getClaims()
            ->toBeArray()
            ->toHaveKey('aud', $jwt->claims['aud'])
            ->toHaveKey('azp', $jwt->claims['azp'])
            ->toHaveKey('auth_time', $jwt->claims['auth_time'])
            ->toHaveKey('exp', $jwt->claims['exp'])
            ->toHaveKey('iat', $jwt->claims['iat'])
            ->toHaveKey('iss', $jwt->claims['iss'])
            ->toHaveKey('nonce', $jwt->claims['nonce'])
            ->toHaveKey('org_id', $jwt->claims['org_id'])
            ->toHaveKey('sub', $jwt->claims['sub']);
})->with(['mocked rs256 id token' => [
    function() {
        $this->configuration->setOrganization(['org123']);
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256, ['org_id' => 'org123'])
]]);

it('defaults to a `jwt` `typ` header if none was present', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Parser($jwt->token, $configuration);

    expect($token)
        ->toBeObject()
        ->getHeader('typ')
            ->toEqual('JWT');
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256, [], ['typ' => null])
]]);

test('hasClaim() returns expected values', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Parser($jwt->token, $configuration);
    expect($token->hasClaim('aud'))->toBeTrue();
    expect($token->hasClaim('xyz'))->toBeFalse();
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);

test('hasHeader() returns expected values', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Parser($jwt->token, $configuration);
    expect($token->hasHeader('typ'))->toBeTrue();
    expect($token->hasHeader('xyz'))->toBeFalse();
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);

test('getRaw() returns a raw token string', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Parser($jwt->token, $configuration);
    expect($token->getRaw())->toEqual($jwt->token);
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);
