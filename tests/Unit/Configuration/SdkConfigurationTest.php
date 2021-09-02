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

    new SdkConfiguration([
        'domain' => $randomNumber,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_INCOMPATIBLE_NULLABLE, 'domain', 'string', 'int'));

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

    $sdk = new SdkConfiguration([
        'domain' => '',
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

test('__construct() throws an exception if an invalid token algorithm is specified', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenAlgorithm' => 'X8675309'
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_INVALID_TOKEN_ALGORITHM);

test('__construct() throws an exception if an invalid token leeway is specified', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenLeeway' => 'TEST'
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_INCOMPATIBLE, 'tokenLeeway', 'int', 'string'));

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
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'strategy' => uniqid(),
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'strategy'));

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
    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `webapp` strategy requires a client id', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
        'domain' => uniqid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `webapp` strategy requires a client secret when HS256 is used', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'webapp',
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'tokenAlgorithm' => 'HS256'
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

test('a `api` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'api',
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `api` strategy requires an audience', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'api',
        'domain' => uniqid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_AUDIENCE);

test('a `management` strategy requires a client id if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'management'
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `management` strategy requires a client secret if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => 'management',
        'clientId' => uniqid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

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

test('formatDomain() returns the custom domain when a custom domain is configured', function(): void
{
    $domain = uniqid();
    $customDomain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain())->toEqual('https://' . $customDomain);
});

test('formatDomain() returns the tenant domain even when a custom domain is configured if `forceTenantDomain` argument is `true`', function(): void
{
    $domain = uniqid();
    $customDomain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain(true))->toEqual('https://' . $domain);
});

test('formatCustomDomain() returns a properly formatted uri', function(): void
{
    $domain = uniqid();
    $customDomain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatCustomDomain())->toEqual('https://' . $customDomain);
});

test('formatCustomDomain() returns null when a custom domain is not configured', function(): void
{
    $domain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatCustomDomain())->toBeNull();
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
