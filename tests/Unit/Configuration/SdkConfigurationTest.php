<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;

uses()->group('configuration');

test('__construct() accepts a configuration array', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);

    expect($sdk->getDomain())->toEqual($domain);
    expect($sdk->getClientId())->toEqual($clientId);
    expect($sdk->getRedirectUri())->toEqual($redirectUri);
});

test('__construct() overrides arguments with configuration array', function(): void
{
    $domain = uniqid();
    $domain2 = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ], $domain2);

    expect($sdk->getDomain())->toEqual($domain);
});

test('__construct() does not accept invalid types from configuration array', function(): void
{
    $randomNumber = mt_rand();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_INCOMPATIBLE_NULLABLE, 'domain', 'string', 'int'));

    new SdkConfiguration([
        'domain' => $randomNumber,
    ]);
});

test('__construct() successfully only stores the host when passed a full uri as `domain`', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => 'https://test.auth0.com/.example-path/nonsense.txt',
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->getDomain())->toEqual('test.auth0.com');
});

test('__construct() throws an exception if domain is an empty string', function(): void {
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

    $sdk = new SdkConfiguration([
        'domain' => '',
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);
});

test('__construct() throws an exception if an invalid token algorithm is specified', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_INVALID_TOKEN_ALGORITHM);

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenAlgorithm' => 'X8675309'
    ]);
});

test('__construct() throws an exception if an invalid token leeway is specified', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_INCOMPATIBLE, 'tokenLeeway', 'int', 'string'));

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenLeeway' => 'TEST'
    ]);
});

test('successfully updates values', function(): void
{
    $domain1 = uniqid();
    $cookieSecret1 = uniqid();
    $clientId1 = uniqid();
    $redirectUri1 = uniqid();

    $domain2 = uniqid();
    $cookieSecret2 = uniqid();
    $clientId2 = uniqid();
    $redirectUri2 = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain1,
        'cookieSecret' => $cookieSecret1,
        'clientId' => $clientId1,
        'redirectUri' => $redirectUri1,
    ]);

    expect($sdk->getDomain())->toEqual($domain1);
    expect($sdk->getCookieSecret())->toEqual($cookieSecret1);
    expect($sdk->getClientId())->toEqual($clientId1);
    expect($sdk->getRedirectUri())->toEqual($redirectUri1);

    $sdk->setDomain($domain2);
    $sdk->setCookieSecret($cookieSecret2);
    $sdk->setClientId($clientId2);
    $sdk->setRedirectUri($redirectUri2);

    expect($sdk->getDomain())->toEqual($domain2);
    expect($sdk->getCookieSecret())->toEqual($cookieSecret2);
    expect($sdk->getClientId())->toEqual($clientId2);
    expect($sdk->getRedirectUri())->toEqual($redirectUri2);
});

test('successfully resets values', function(): void
{
    $domain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'usePkce' => false,
    ]);

    expect($sdk->getDomain())->toEqual($domain);
    expect($sdk->getUsePkce())->toBeFalse();

    $sdk->reset();

    expect($sdk->getDomain())->toEqual(null);
    expect($sdk->getUsePkce())->toBeTrue();
});

test('an invalid strategy throws an exception', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'strategy'));

    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'strategy' => uniqid(),
    ]);
});

test('a non-existent array value is ignored', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'organization' => [],
    ]);

    expect($sdk->getOrganization())->toBeNull();
});

test('a `webapp` strategy is used by default', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
    ]);

    expect($sdk->getStrategy())->toEqual('webapp');
});

test('a `webapp` strategy requires a domain', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
    ]);
});

test('a `webapp` strategy requires a client id', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
        'domain' => uniqid()
    ]);
});

test('a `webapp` strategy requires a client secret when HS256 is used', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'tokenAlgorithm' => 'HS256'
    ]);
});

test('a `api` strategy requires a domain', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

    $sdk = new SdkConfiguration([
        'strategy' => 'api',
    ]);
});

test('a `api` strategy requires an audience', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_AUDIENCE);

    $sdk = new SdkConfiguration([
        'strategy' => 'api',
        'domain' => uniqid()
    ]);
});

test('a `management` strategy requires a client id if a management token is not provided', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

    $sdk = new SdkConfiguration([
        'strategy' => 'management'
    ]);
});

test('a `management` strategy requires a client secret if a management token is not provided', function(): void
{
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

    $sdk = new SdkConfiguration([
        'strategy' => 'management',
        'clientId' => uniqid()
    ]);
});

test('a `management` strategy does not require a client id or secret if a management token is provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'management',
        'managementToken' => uniqid()
    ]);

    expect($sdk)->toBeInstanceOf(SdkConfiguration::class);
});

test('formatDomain() returns a properly formatted uri', function(): void
{
    $domain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain())->toEqual('https://' . $domain);
});

test('formatScope() returns an empty string when there are no scopes defined', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => [],
    ]);

    expect($sdk->formatScope())->toEqual('');
});

test('scope() successfully converts the array to a string', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => ['one', 'two', 'three'],
    ]);

    expect($sdk->formatScope())->toEqual('one two three');
});

test('defaultOrganization() successfully returns the first organization', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'organization' => ['org1', 'org2', 'org3'],
    ]);

    expect($sdk->defaultOrganization())->toEqual('org1');
});

test('defaultAudience() successfully returns the first audience', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'audience' => ['aud1', 'aud2', 'aud3'],
    ]);

    expect($sdk->defaultAudience())->toEqual('aud1');
});
