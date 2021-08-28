<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

// uses()->group('token');

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

    $this->assertIsObject($token);
    $this->assertEquals($jwt->claims['aud'] ?? null, $token->getAudience()[0] ?? null);
    $this->assertEquals($jwt->claims['azp'] ?? null, $token->getAuthorizedParty());
    $this->assertEquals($jwt->claims['auth_time'] ?? null, $token->getAuthTime());
    $this->assertEquals($jwt->claims['exp'] ?? null, $token->getExpiration());
    $this->assertEquals($jwt->claims['iat'] ?? null, $token->getIssued());
    $this->assertEquals($jwt->claims['iss'] ?? null, $token->getIssuer());
    $this->assertEquals($jwt->claims['nonce'] ?? null, $token->getNonce());
    $this->assertEquals($jwt->claims['org_id'] ?? null, $token->getOrganization());
    $this->assertEquals($jwt->claims['sub'] ?? null, $token->getSubject());
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);

it('accepts and successfully parses a valid HS256 ID Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    $this->assertIsObject($token);
    $this->assertEquals($jwt->claims['aud'] ?? null, $token->getAudience()[0] ?? null);
    $this->assertEquals($jwt->claims['azp'] ?? null, $token->getAuthorizedParty());
    $this->assertEquals($jwt->claims['auth_time'] ?? null, $token->getAuthTime());
    $this->assertEquals($jwt->claims['exp'] ?? null, $token->getExpiration());
    $this->assertEquals($jwt->claims['iat'] ?? null, $token->getIssued());
    $this->assertEquals($jwt->claims['iss'] ?? null, $token->getIssuer());
    $this->assertEquals($jwt->claims['nonce'] ?? null, $token->getNonce());
    $this->assertEquals($jwt->claims['org_id'] ?? null, $token->getOrganization());
    $this->assertEquals($jwt->claims['sub'] ?? null, $token->getSubject());
})->with(['mocked hs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);

it('accepts and successfully parses a valid RS256 Access Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_TOKEN);

    $this->assertIsObject($token);
    $this->assertEquals($jwt->claims['aud'] ?? null, $token->getAudience()[0] ?? null);
    $this->assertEquals($jwt->claims['azp'] ?? null, $token->getAuthorizedParty());
    $this->assertEquals($jwt->claims['auth_time'] ?? null, $token->getAuthTime());
    $this->assertEquals($jwt->claims['exp'] ?? null, $token->getExpiration());
    $this->assertEquals($jwt->claims['iat'] ?? null, $token->getIssued());
    $this->assertEquals($jwt->claims['iss'] ?? null, $token->getIssuer());
    $this->assertEquals($jwt->claims['nonce'] ?? null, $token->getNonce());
    $this->assertEquals($jwt->claims['org_id'] ?? null, $token->getOrganization());
    $this->assertEquals($jwt->claims['sub'] ?? null, $token->getSubject());
})->with(['mocked rs256 access token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

it('accepts and successfully parses a valid HS256 Access Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_TOKEN);

    $this->assertIsObject($token);
    $this->assertEquals($jwt->claims['aud'] ?? null, $token->getAudience()[0] ?? null);
    $this->assertEquals($jwt->claims['azp'] ?? null, $token->getAuthorizedParty());
    $this->assertEquals($jwt->claims['auth_time'] ?? null, $token->getAuthTime());
    $this->assertEquals($jwt->claims['exp'] ?? null, $token->getExpiration());
    $this->assertEquals($jwt->claims['iat'] ?? null, $token->getIssued());
    $this->assertEquals($jwt->claims['iss'] ?? null, $token->getIssuer());
    $this->assertEquals($jwt->claims['nonce'] ?? null, $token->getNonce());
    $this->assertEquals($jwt->claims['org_id'] ?? null, $token->getOrganization());
    $this->assertEquals($jwt->claims['sub'] ?? null, $token->getSubject());
})->with(['mocked hs256 access token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_HS256)
]]);

test('verify() returns a fluent interface', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    $this->assertEquals($token, $token->verify());
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

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_UNEXPECTED_SIGNING_ALGORITHM, 'RS256', 'HS256'));

    $token->verify('RS256');
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setTokenAlgorithm('HS256');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);

test('validate() returns a fluent interface', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    $this->assertEquals($token, $token->validate(null, null, ['__test_org__'], $claims['nonce'], 100));
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

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_AUD_CLAIM, $claims['aud'], '__test_client_id__'));

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
]]);

test('toArray() returns an array', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    $this->assertIsArray($token->toArray());
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
    $this->assertIsString($json);
    $this->assertNotNull(json_decode($json, true, 512, JSON_THROW_ON_ERROR));
})->with(['mocked data' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]]);
