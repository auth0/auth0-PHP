<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\Tests\Utilities\MockDomain;

uses()->group('configuration');

test('__construct() accepts a configuration array', function(): void {
    $domain = MockDomain::valid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);

    expect($sdk->getDomain())->toEqual(parse_url($domain, PHP_URL_HOST));
    expect($sdk->getClientId())->toEqual($clientId);
    expect($sdk->getRedirectUri())->toEqual($redirectUri);
});

test('__construct() overrides arguments with configuration array', function(): void
{
    $domain = MockDomain::valid();
    $domain2 = MockDomain::valid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ], SdkConfiguration::STRATEGY_REGULAR, $domain2);

    expect($sdk->getDomain())->toEqual(parse_url($domain, PHP_URL_HOST));
});

test('__construct() does not accept invalid types from configuration array', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE,
        'domain' => MockDomain::invalid(),
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

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

test('__construct() throws an exception if domain is an invalid uri', function(): void {
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => '₠',
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

test('__construct() throws an exception if cookieSecret is undefined', function(): void {
    $domain = MockDomain::valid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => null,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

test('__construct() throws an exception if cookieSecret is an empty string', function(): void {
    $domain = MockDomain::valid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => '',
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

test('__construct() throws an exception if an invalid token algorithm is specified', function(): void {
    $domain = MockDomain::valid();
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
    $domain = MockDomain::valid();
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
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'tokenLeeway'));

test('successfully updates values', function(): void
{
    $domain1 = MockDomain::valid();
    $cookieSecret1 = uniqid();
    $clientId1 = uniqid();
    $redirectUri1 = uniqid();

    $domain2 = MockDomain::valid();
    $cookieSecret2 = uniqid();
    $clientId2 = uniqid();
    $redirectUri2 = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain1,
        'cookieSecret' => $cookieSecret1,
        'clientId' => $clientId1,
        'redirectUri' => $redirectUri1,
    ]);

    expect($sdk->getDomain())->toEqual(parse_url($domain1, PHP_URL_HOST));
    expect($sdk->getCookieSecret())->toEqual($cookieSecret1);
    expect($sdk->getClientId())->toEqual($clientId1);
    expect($sdk->getRedirectUri())->toEqual($redirectUri1);

    $sdk->setDomain($domain2);
    $sdk->setCookieSecret($cookieSecret2);
    $sdk->setClientId($clientId2);
    $sdk->setRedirectUri($redirectUri2);

    expect($sdk->getDomain())->toEqual(parse_url($domain2, PHP_URL_HOST));
    expect($sdk->getCookieSecret())->toEqual($cookieSecret2);
    expect($sdk->getClientId())->toEqual($clientId2);
    expect($sdk->getRedirectUri())->toEqual($redirectUri2);
});

test('an invalid strategy throws an exception', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'clientId' => uniqid(),
        'strategy' => uniqid(),
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'strategy'));

test('a non-existent array value is ignored', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE,
        'domain' => MockDomain::valid(),
        'clientId' => uniqid(),
        'organization' => [],
    ]);

    expect($sdk->getOrganization())->toBeNull();
});

test('a `webapp` strategy is used by default', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'clientId' => uniqid(),
        'cookieSecret' => uniqid(),
    ]);

    expect($sdk->getStrategy())->toEqual('webapp');
});

test('a `webapp` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'cookieSecret' => uniqid(),
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `webapp` strategy requires a client id', function(): void
{
    $sdk = new SdkConfiguration([
        'cookieSecret' => uniqid(),
        'domain' => MockDomain::valid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `webapp` strategy requires a client secret when HS256 is used', function(): void
{
    $sdk = new SdkConfiguration([
        'cookieSecret' => uniqid(),
        'domain' => MockDomain::valid(),
        'clientId' => uniqid(),
        'tokenAlgorithm' => 'HS256'
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

test('a `api` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_API,
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `api` strategy requires an audience', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_API,
        'domain' => MockDomain::valid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_AUDIENCE);

test('a `management` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `management` strategy requires a client id if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API,
        'domain' => MockDomain::valid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `management` strategy requires a client secret if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API,
        'domain' => MockDomain::valid(),
        'clientId' => uniqid()
    ]);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

test('a `management` strategy does not require a client id or secret if a management token is provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API,
        'domain' => MockDomain::valid(),
        'managementToken' => uniqid()
    ]);

    expect($sdk)->toBeInstanceOf(SdkConfiguration::class);
});

test('formatDomain() returns a properly formatted uri', function(): void
{
    $domain = MockDomain::valid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain())->toEqual($domain);
});

test('formatDomain() returns the custom domain when a custom domain is configured', function(): void
{
    $domain = MockDomain::valid();
    $customDomain = MockDomain::valid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain())->toEqual($customDomain);
});

test('formatDomain() returns the tenant domain even when a custom domain is configured if `forceTenantDomain` argument is `true`', function(): void
{
    $domain = MockDomain::valid();
    $customDomain = MockDomain::valid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatDomain(true))->toEqual($domain);
});

test('formatCustomDomain() returns a properly formatted uri', function(): void
{
    $domain = MockDomain::valid();
    $customDomain = MockDomain::valid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'customDomain' => $customDomain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatCustomDomain())->toEqual( $customDomain);
});

test('formatCustomDomain() returns null when a custom domain is not configured', function(): void
{
    $domain = MockDomain::valid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    expect($sdk->formatCustomDomain())->toBeNull();
});

test('formatScope() returns the default scopes when there are no scopes defined', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => [],
    ]);

    expect($sdk->formatScope())->toEqual('openid profile email');
});

test('formatScope() returns the correct string when there scopes are defined', function(): void
{
    $scope1 = uniqid();
    $scope2 = uniqid();
    $scope3 = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => [$scope1, $scope2, $scope3],
    ]);

    expect($sdk->formatScope())->toEqual(implode(' ', [$scope1, $scope2, $scope3]));
});

test('scope() successfully converts the array to a string', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => ['one', 'two', 'three'],
    ]);

    expect($sdk->formatScope())->toEqual('one two three');
});

test('scope() successfully reverts to the default values when an empty array is provided', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => [],
    ]);

    expect($sdk->getScope())->toEqual(['openid', 'profile', 'email']);
});

test('scope() successfully reverts to the default values when a null value is provided', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => null,
    ]);

    expect($sdk->getScope())->toEqual(['openid', 'profile', 'email']);
});

test('defaultOrganization() successfully returns the first organization', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => MockDomain::valid(),
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
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'audience' => ['aud1', 'aud2', 'aud3'],
    ]);

    expect($sdk->defaultAudience())->toEqual('aud1');
});
