<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token;
use Auth0\SDK\Token\Generator;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('token');

beforeEach(function() {
    $this->cache = new ArrayAdapter();

    $this->configuration = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE,
        'tokenCache' => $this->cache
    ]);
});

test('parse() returns a static reference to the Token class', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token)->toBeObject();

    $parsed = $token->parse();
    expect($parsed)->toBeInstanceOf(Token::class);
    expect($parsed)->toEqual($token);
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_RS256)
]]);

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
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
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
    expect($token->getAudience())->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked hs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['aud' => ['123', '456']])
]]);

it('accepts and successfully parses a valid RS256 Access Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ACCESS_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
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
    $token = new Token($configuration, $jwt->token, Token::TYPE_ACCESS_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getNonce())->toEqual($jwt->claims['nonce'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked hs256 access token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_HS256)
]]);

it('accepts and successfully parses a valid RS256 Logout Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked rs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_RS256)
]]);

it('accepts and successfully parses a valid HS256 Logout Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);

    expect($token)->toBeObject();
    expect($token->getAudience()[0] ?? null)->toEqual($jwt->claims['aud'] ?? null);
    expect($token->getAuthorizedParty())->toEqual($jwt->claims['azp'] ?? null);
    expect($token->getAuthTime())->toEqual($jwt->claims['auth_time'] ?? null);
    expect($token->getExpiration())->toEqual($jwt->claims['exp'] ?? null);
    expect($token->getIdentifier())->toEqual($jwt->claims['sid'] ?? null);
    expect($token->getIssued())->toEqual($jwt->claims['iat'] ?? null);
    expect($token->getIssuer())->toEqual($jwt->claims['iss'] ?? null);
    expect($token->getOrganization())->toEqual($jwt->claims['org_id'] ?? null);
    expect($token->getSubject())->toEqual($jwt->claims['sub'] ?? null);
})->with(['mocked hs256 id token' => [
    fn() => $this->configuration,
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256)
]]);

it('fails validating an otherwise valid Id Token as a Logout Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256)
]])->throws(InvalidTokenException::class, InvalidTokenException::MSG_LOGOUT_TOKEN_NONCE_PRESENT);

it('fails validating an otherwise valid Access Token as a Logout Token', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_HS256)
]])->throws(InvalidTokenException::class, InvalidTokenException::MSG_LOGOUT_TOKEN_NONCE_PRESENT);

it('fails validating a Logout Token without `sub` or `sid` claims', function(
    SdkConfiguration $configuration
): void {
    $key = TokenGenerator::generateRsaKeyPair();

    $claims = [
        // 'sub' => '__test_sub__',
        // 'sid' => '__test_sid__',
        'iss' => 'https://domain.test/',
        'aud' => '__test_client_id__',
        'auth_time' => time() - 100,
        'exp' => time() + 1000,
        'iat' => time() - 1000,
        'azp' => '__test_azp__',
        'events' => [
            'http://schemas.openid.net/event/backchannel-logout' => [],
        ],
    ];

    $jwt = (string) Generator::create(
        signingKey: $key['private'],
        algorithm: Token::ALGO_RS256,
        claims: $claims,
        headers: []
    );

    $token = new Token($configuration, $jwt, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    }
]])->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_SUB_AND_SID_CLAIMS);

it('fails validating a Logout Token with a `nonce` claim', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256, ['nonce' => '__test_nonce__'])
]])->throws(InvalidTokenException::class, InvalidTokenException::MSG_LOGOUT_TOKEN_NONCE_PRESENT);

it('fails validating a Logout Token without an `events` claim', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256, ['events' => null])
]])->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_EVENTS_CLAIM);

it('fails validating a Logout Token with a mismatch `issuer` claim', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('invalid-domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256)
]])->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_MISMATCHED_ISS_CLAIM, "https://invalid-domain.test/", "https://domain.test/"));

it('fails validating a Logout Token with a mismatch `issuer` claim with custom domain', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('invalid-domain.test');
        $this->configuration->setCustomDomain('invalid-custom-domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256)
]])->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_MISMATCHED_ISS_CLAIM, "https://invalid-domain.test/", "https://domain.test/"));


it('fails validating a Logout Token with a malformed `events` claim', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);
    $token->validate();
})->with(['mocked hs256 access token' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_LOGOUT, TokenGenerator::ALG_HS256, ['events' => ['http://schemas.openid.net/event/backchannel-logout' => true]])
]])->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_BAD_EVENT_CLAIM, 'http://schemas.openid.net/event/backchannel-logout', 'object'));

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
]])->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_UNEXPECTED_SIGNING_ALGORITHM, 'RS256', 'HS256'));

test('validate() returns a fluent interface', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->validate(null, null, ['org_123'], $claims['nonce'], 100))->toEqual($token);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['org_id' => 'org_123']),
    fn() => ['nonce' => '__test_nonce__']
]]);

test('validate() with custom domain as token issuer fails, but succeeds with tenant domain', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->validate(null, null, ['org_123'], $claims['nonce'], 100))->toEqual($token);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('domain.test');
        $this->configuration->setCustomDomain('not-the-issuer.domain');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['org_id' => 'org_123']),
    fn() => ['nonce' => '__test_nonce__']
]]);

test('validate() with custom domain as token issuer succeeds, tenant domain is thereby irrelevant', function(
    SdkConfiguration $configuration,
    TokenGeneratorResponse $jwt,
    array $claims
): void {
    $token = new Token($configuration, $jwt->token, Token::TYPE_ID_TOKEN);
    expect($token->validate(null, null, ['org_123'], $claims['nonce'], 100))->toEqual($token);
})->with(['mocked data' => [
    function(): SdkConfiguration {
        $this->configuration->setDomain('invalid-domain.test');
        $this->configuration->setCustomDomain('domain.test');
        $this->configuration->setClientId('__test_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        $this->configuration->setClientSecret('__test_client_secret__');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['org_id' => 'org_123']),
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
        $this->configuration->setDomain('domain.test');
        $this->configuration->setClientId('__diff_client_id__');
        $this->configuration->setTokenAlgorithm('HS256');
        return $this->configuration;
    },
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256),
    fn() => ['aud' => uniqid()]
]])->throws(InvalidTokenException::class);

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

test('getAudience() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['aud' => true]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getAudience())
        ->toBeNull();
});

test('getAuthorizedParty() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['azp' => 123]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getAuthorizedParty())
        ->toBeNull();
});

test('getAuthTime() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['auth_time' => 'testing']);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getAuthTime())
        ->toBeNull();
});

test('getExpiration() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['exp' => 'testing']);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getExpiration())
        ->toBeNull();
});

test('getIdentifier() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['sid' => 123]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getIdentifier())
        ->toBeNull();
});

test('getIssued() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['iat' => 'testing']);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getIssued())
        ->toBeNull();
});

test('getIssuer() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['iss' => 123]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getIssuer())
        ->toBeNull();
});

test('getNonce() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['nonce' => true]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getNonce())
        ->toBeNull();
});

test('getOrganization() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['org_id' => true]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getOrganization())
        ->toBeNull();
});

test('getSubject() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['sub' => true]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_ID_TOKEN);

    expect($token->getSubject())
        ->toBeNull();
});

test('getEvents() rejects malformed claims', function(): void {
    $jwt = TokenGenerator::create(TokenGenerator::TOKEN_ID, TokenGenerator::ALG_HS256, ['events' => true]);
    $token = new Token($this->configuration, $jwt->token, Token::TYPE_LOGOUT_TOKEN);

    expect($token->getEvents())
        ->toBeNull();
});
