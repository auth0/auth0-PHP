<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('token');

beforeEach(function() {
    $this->cache = new ArrayAdapter();

    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'tokenCache' => $this->cache
    ]);
});

it('accepts and successfully parses a valid RS256 ID Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);

it('accepts and successfully parses a valid HS256 ID Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked hs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);

it('accepts and successfully parses a valid RS256 Access Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked rs256 access token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

it('accepts and successfully parses a valid HS256 Access Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked hs256 access token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_HS256)
]]);

test('verify() returns a fluent interface', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->verify())->toEqual($token);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);

test('verify() overrides globally configured algorithm', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    $token->verify('RS256');
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setTokenAlgorithm('HS256');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]])->throws(\Auth0\SDK\Exception\InvalidTokenException::class, sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_UNEXPECTED_SIGNING_ALGORITHM, 'RS256', 'HS256'));

test('validate() returns a fluent interface', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->validate(null, null, ['__test_org__'], $claims['nonce'], 100))->toEqual($token);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('__test_domain__');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['org_id' => '__test_org__']),
    fn() => ['nonce' => '__test_nonce__']
]]);

test('validate() overrides globally configured algorithm', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    $token->validate(null, [ $claims['aud'] ]);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('__test_domain__');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256),
    fn() => ['aud' => uniqid()]
]])->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('toArray() returns an array', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->toArray())->toBeArray();
})->with(['mocked data' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);

test('toJson() returns a valid JSON-encoded string', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    $json = $token->toJson();
    expect($json)->toBeString();
    $this->assertNotNull(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
})->with(['mocked data' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);
