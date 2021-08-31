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

    expect($token)->toBeObject();
    expect($token->getClaims())->toBeArray();
    // $this->assertEquals($jwt->claims['aud'] ?? null, $token->getAudience()[0] ?? null);
    // $this->assertEquals($jwt->claims['azp'] ?? null, $token->getAuthorizedParty());
    // $this->assertEquals($jwt->claims['auth_time'] ?? null, $token->getAuthTime());
    // $this->assertEquals($jwt->claims['exp'] ?? null, $token->getExpiration());
    // $this->assertEquals($jwt->claims['iat'] ?? null, $token->getIssued());
    // $this->assertEquals($jwt->claims['iss'] ?? null, $token->getIssuer());
    // $this->assertEquals($jwt->claims['nonce'] ?? null, $token->getNonce());
    // $this->assertEquals($jwt->claims['org_id'] ?? null, $token->getOrganization());
    // $this->assertEquals($jwt->claims['sub'] ?? null, $token->getSubject());
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);
