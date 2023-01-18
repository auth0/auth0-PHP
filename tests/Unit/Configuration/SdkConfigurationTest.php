<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Token;
use Auth0\Tests\Utilities\MockDomain;
use Auth0\Tests\Utilities\MockPsr14StoreListener;
use Auth0\Tests\Utilities\MockStore;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

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
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

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
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

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
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'domain'));

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
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

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
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_COOKIE_SECRET);

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
})->throws(ConfigurationException::class, ConfigurationException::MSG_INVALID_TOKEN_ALGORITHM);

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
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'tokenLeeway'));

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
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'strategy'));

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
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `webapp` strategy requires a client id', function(): void
{
    $sdk = new SdkConfiguration([
        'cookieSecret' => uniqid(),
        'domain' => MockDomain::valid()
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `webapp` strategy requires a client secret when HS256 is used', function(): void
{
    $sdk = new SdkConfiguration([
        'cookieSecret' => uniqid(),
        'domain' => MockDomain::valid(),
        'clientId' => uniqid(),
        'tokenAlgorithm' => 'HS256'
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

test('a `api` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_API,
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `api` strategy requires an audience', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_API,
        'domain' => MockDomain::valid()
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_AUDIENCE);

test('a `management` strategy requires a domain', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_DOMAIN);

test('a `management` strategy requires a client id if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API,
        'domain' => MockDomain::valid()
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('a `management` strategy requires a client secret if a management token is not provided', function(): void
{
    $sdk = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_MANAGEMENT_API,
        'domain' => MockDomain::valid(),
        'clientId' => uniqid()
    ]);
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

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

test('Audience methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasAudience())->toBeFalse();

    $config->setAudience(null);
    expect($config->getAudience())->toBeNull();

    $config->setAudience(['123', null, 456]);
    expect($config->getAudience())->toEqual(['123', '456']);

    $config->setAudience([]);
    expect($config->getAudience())->toBeNull();

    $config->pushAudience('');
    expect($config->getAudience())->toBeNull();

    $config->pushAudience([]);
    expect($config->getAudience())->toBeNull();

    $config->pushAudience('123');
    expect($config->getAudience())->toEqual(['123']);

    $config->pushAudience([null, 456, null, '', 'test']);
    expect($config->getAudience())->toEqual(['123', '456', 'test']);

    expect($config->hasAudience())->toBeTrue();
});

test('getAudience() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->getAudience(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('CookieDomain methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasCookieDomain())->toBeTrue();
    expect($config->getCookieDomain())->toEqual($config->getRedirectUri());

    $config->setCookieDomain('test');
    expect($config->getCookieDomain())->toEqual('test');

    $config->setCookieDomain(null);
    expect($config->getCookieDomain())->toEqual($config->getRedirectUri());

    $config->setCookieDomain(' ');
    expect($config->getCookieDomain())->toEqual($config->getRedirectUri());

    $config->setRedirectUri('https://test.auth0.com/test');
    expect($config->getCookieDomain())->toEqual('test.auth0.com');
    expect($config->hasCookieDomain())->toBeTrue();

    $config->setRedirectUri(null);
    $_SERVER['SERVER_NAME'] = '';
    $_SERVER['HTTP_HOST'] = '';
    expect($config->getCookieDomain())->toBeNull();
    expect($config->hasCookieDomain())->toBeFalse();

    $_SERVER['HTTP_HOST'] = 'test.com';
    expect($config->getCookieDomain())->toEqual('test.com');
    expect($config->hasCookieDomain())->toBeTrue();

    $_SERVER['HTTP_HOST'] = '';
    $_SERVER['SERVER_NAME'] = '123.com';
    expect($config->getCookieDomain())->toEqual('123.com');
    expect($config->hasCookieDomain())->toBeTrue();
});

test('CookieExpires methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasCookieExpires())->toBeTrue();
    expect($config->getCookieExpires())->toEqual(0);

    $config->setCookieExpires(100);
    expect($config->getCookieExpires())->toEqual(100);
});

test('setCookieExpires() throws a ConfigurationException when a negative value is provided', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->setCookieExpires(-100);
    expect($config->getCookieExpires())->toEqual(0);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'cookieExpires'));

test('CookiePath methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasCookiePath())->toBeTrue();
    expect($config->getCookiePath())->toEqual('/');

    $config->setCookiePath('/123');
    expect($config->getCookiePath())->toEqual('/123');

    $config->setCookiePath('  /');
    expect($config->getCookiePath())->toEqual('/');

    $config->setCookiePath('/  ');
    expect($config->getCookiePath())->toEqual('/');

    $config->setCookiePath('    ');
    expect($config->getCookiePath())->toEqual('/');

    $config->setCookiePath('test');
    expect($config->getCookiePath())->toEqual('/test');
});

test('CookieSameSite methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasCookieSameSite())->toBeFalse();
    expect($config->getCookieSameSite())->toBeNull();

    $config->setCookieSameSite('lax');
    expect($config->hasCookieSameSite())->toBeTrue();
    expect($config->getCookieSameSite())->toEqual('lax');

    $config->setCookieSameSite('   ');
    expect($config->hasCookieSameSite())->toBeFalse();
    expect($config->getCookieSameSite())->toBeNull();

    $config->setCookieSameSite(null);
    expect($config->hasCookieSameSite())->toBeFalse();
    expect($config->getCookieSameSite())->toBeNull();
});

test('getCookieSameSite() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->getCookieSameSite(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('CookieSecure methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasCookieSecure())->toBeTrue();
    expect($config->getCookieSecure())->toBeFalse();

    $config->setCookieSecure(true);
    expect($config->getCookieSecure())->toBeTrue();
});

test('ClientId methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasClientId())->toBeFalse();
    expect($config->getClientId())->toBeNull();

    $config->setClientId('test');
    expect($config->hasClientId())->toBeTrue();
    expect($config->getClientId())->toEqual('test');

    $config->setClientId('   ');
    expect($config->hasClientId())->toBeFalse();
    expect($config->getClientId())->toBeNull();

    $config->setClientId('   test');
    expect($config->hasClientId())->toBeTrue();
    expect($config->getClientId())->toEqual('test');

    $config->setClientId(null);
    expect($config->hasClientId())->toBeFalse();
    expect($config->getClientId())->toBeNull();

    $config->setClientId('test  ');
    expect($config->hasClientId())->toBeTrue();
    expect($config->getClientId())->toEqual('test');
});

test('getClientId() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getClientId(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('ClientSecret methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasClientSecret())->toBeFalse();
    expect($config->getClientSecret())->toBeNull();

    $config->setClientSecret('test');
    expect($config->hasClientSecret())->toBeTrue();
    expect($config->getClientSecret())->toEqual('test');

    $config->setClientSecret('   ');
    expect($config->hasClientSecret())->toBeFalse();
    expect($config->getClientSecret())->toBeNull();

    $config->setClientSecret('   test');
    expect($config->hasClientSecret())->toBeTrue();
    expect($config->getClientSecret())->toEqual('test');

    $config->setClientSecret(null);
    expect($config->hasClientSecret())->toBeFalse();
    expect($config->getClientSecret())->toBeNull();

    $config->setClientSecret('test  ');
    expect($config->hasClientSecret())->toBeTrue();
    expect($config->getClientSecret())->toEqual('test');
});

test('getClientSecret() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getClientSecret(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('CustomDomain methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasCustomDomain())->toBeFalse();
    expect($config->getCustomDomain())->toBeNull();

    $config->setCustomDomain('test.com');
    expect($config->hasCustomDomain())->toBeTrue();
    expect($config->getCustomDomain())->toEqual('test.com');

    $config->setCustomDomain('   ');
    expect($config->hasCustomDomain())->toBeFalse();
    expect($config->getCustomDomain())->toBeNull();

    $config->setCustomDomain('   test.com');
    expect($config->hasCustomDomain())->toBeTrue();
    expect($config->getCustomDomain())->toEqual('test.com');

    $config->setCustomDomain(null);
    expect($config->hasCustomDomain())->toBeFalse();
    expect($config->getCustomDomain())->toBeNull();

    $config->setCustomDomain('test.com  ');
    expect($config->hasCustomDomain())->toBeTrue();
    expect($config->getCustomDomain())->toEqual('test.com');
});

test('setCustomDomain() throws a ConfigurationException when an invalid domain is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setCustomDomain('test');
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'customDomain'));

test('getCustomDomain() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getCustomDomain(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('EventListenerProvider methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $listener = new MockPsr14StoreListener();

    expect($config->hasEventListenerProvider())->toBeFalse();
    expect($config->getEventListenerProvider())->toBeNull();

    $config->setEventListenerProvider($listener->getProvider());
    expect($config->hasEventListenerProvider())->toBeTrue();
    expect($config->getEventListenerProvider())->toEqual($listener->getProvider());

    $config->setEventListenerProvider(null);
    expect($config->hasEventListenerProvider())->toBeFalse();
    expect($config->getEventListenerProvider())->toBeNull();
});

test('getEventListenerProvider() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getEventListenerProvider(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('HttpClient methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    // The test suite includes a mock client, so this will be true initially here.
    expect($config->hasHttpClient())->toBeTrue();
    expect($config->getHttpClient())->toBeInstanceOf(ClientInterface::class);

    $client = Mockery::mock(ClientInterface::class);

    $config->setHttpClient($client);
    expect($config->hasHttpClient())->toBeTrue();
    expect($config->getHttpClient())->toEqual($client);

    $config->setHttpClient(null);
    expect($config->hasHttpClient())->toBeFalse();
    expect($config->getHttpClient())->toBeNull();
});

test('getHttpClient() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setHttpClient(null);
    $config->getHttpClient(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('HttpMaxRetires methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasHttpMaxRetries())->toBeTrue();
    expect($config->getHttpMaxRetries())->toEqual(3);

    $config->setHttpMaxRetries(100);
    expect($config->getHttpMaxRetries())->toEqual(100);
});

test('setHttpMaxRetries() throws a ConfigurationException when a negative value is provided', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->setHttpMaxRetries(-100);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'httpMaxRetries'));

test('HttpRequestFactory methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    // The test suite includes a mock factory, so this will be true initially here.
    expect($config->hasHttpRequestFactory())->toBeTrue();
    expect($config->getHttpRequestFactory())->toBeInstanceOf(RequestFactoryInterface::class);

    $factory = Mockery::mock(RequestFactoryInterface::class);

    $config->setHttpRequestFactory($factory);
    expect($config->hasHttpRequestFactory())->toBeTrue();
    expect($config->getHttpRequestFactory())->toEqual($factory);

    $config->setHttpRequestFactory(null);
    expect($config->hasHttpRequestFactory())->toBeFalse();
    expect($config->getHttpRequestFactory())->toBeNull();
});

test('getHttpRequestFactory() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setHttpRequestFactory(null);
    $config->getHttpRequestFactory(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('HttpResponseFactory methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    // The test suite includes a mock factory, so this will be true initially here.
    expect($config->hasHttpResponseFactory())->toBeTrue();
    expect($config->getHttpResponseFactory())->toBeInstanceOf(ResponseFactoryInterface::class);

    $factory = Mockery::mock(ResponseFactoryInterface::class);

    $config->setHttpResponseFactory($factory);
    expect($config->hasHttpResponseFactory())->toBeTrue();
    expect($config->getHttpResponseFactory())->toEqual($factory);

    $config->setHttpResponseFactory(null);
    expect($config->hasHttpResponseFactory())->toBeFalse();
    expect($config->getHttpResponseFactory())->toBeNull();
});

test('getHttpResponseFactory() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setHttpResponseFactory(null);
    $config->getHttpResponseFactory(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('HttpStreamFactory methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    // The test suite includes a mock factory, so this will be true initially here.
    expect($config->hasHttpStreamFactory())->toBeTrue();
    expect($config->getHttpStreamFactory())->toBeInstanceOf(StreamFactoryInterface::class);

    $factory = Mockery::mock(StreamFactoryInterface::class);

    $config->setHttpStreamFactory($factory);
    expect($config->hasHttpStreamFactory())->toBeTrue();
    expect($config->getHttpStreamFactory())->toEqual($factory);

    $config->setHttpStreamFactory(null);
    expect($config->hasHttpStreamFactory())->toBeFalse();
    expect($config->getHttpStreamFactory())->toBeNull();
});

test('getHttpStreamFactory() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setHttpStreamFactory(null);
    $config->getHttpStreamFactory(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('HttpTelemetry methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasHttpTelemetry())->toBeTrue();
    expect($config->getHttpTelemetry())->toBeTrue();

    $config->setHttpTelemetry(false);
    expect($config->getHttpTelemetry())->toBeFalse();

    $config->setHttpTelemetry(true);
    expect($config->getHttpTelemetry())->toBeTrue();
});

test('ManagementToken methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasManagementToken())->toBeFalse();
    expect($config->getManagementToken())->toBeNull();

    $config->setManagementToken('1234567890');
    expect($config->hasManagementToken())->toBeTrue();
    expect($config->getManagementToken())->toEqual('1234567890');

    $config->setManagementToken('   ');
    expect($config->hasManagementToken())->toBeFalse();
    expect($config->getManagementToken())->toBeNull();

    $config->setManagementToken('   1234567890');
    expect($config->hasManagementToken())->toBeTrue();
    expect($config->getManagementToken())->toEqual('1234567890');

    $config->setManagementToken(null);
    expect($config->hasManagementToken())->toBeFalse();
    expect($config->getManagementToken())->toBeNull();

    $config->setManagementToken('1234567890  ');
    expect($config->hasManagementToken())->toBeTrue();
    expect($config->getManagementToken())->toEqual('1234567890');
});

test('getManagementToken() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getManagementToken(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('ManagementTokenCache methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $cache = new ArrayAdapter();

    expect($config->hasManagementTokenCache())->toBeFalse();
    expect($config->getManagementTokenCache())->toBeNull();

    $config->setManagementTokenCache($cache);
    expect($config->hasManagementTokenCache())->toBeTrue();
    expect($config->getManagementTokenCache())->toEqual($cache);
});

test('getManagementTokenCache() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getManagementTokenCache(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('Organization methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasOrganization())->toBeFalse();

    $config->setOrganization(null);
    expect($config->getOrganization())->toBeNull();

    $config->setOrganization(['123', null, 456]);
    expect($config->getOrganization())->toEqual(['123', '456']);

    $config->setOrganization([]);
    expect($config->getOrganization())->toBeNull();

    $config->pushOrganization('');
    expect($config->getOrganization())->toBeNull();

    $config->pushOrganization([]);
    expect($config->getOrganization())->toBeNull();

    $config->pushOrganization('123');
    expect($config->getOrganization())->toEqual(['123']);

    $config->pushOrganization([null, 456, null, '', 'test']);
    expect($config->getOrganization())->toEqual(['123', '456', 'test']);

    expect($config->hasOrganization())->toBeTrue();
});

test('getOrganization() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->getOrganization(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('Persistence methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasPersistAccessToken())->toBeTrue();
    expect($config->hasPersistIdToken())->toBeTrue();
    expect($config->hasPersistRefreshToken())->toBeTrue();
    expect($config->hasPersistUser())->toBeTrue();

    $config->setPersistAccessToken(false);
    expect($config->getPersistAccessToken())->toBeFalse();
    $config->setPersistAccessToken(true);
    expect($config->getPersistAccessToken())->toBeTrue();

    $config->setPersistIdToken(false);
    expect($config->getPersistIdToken())->toBeFalse();
    $config->setPersistIdToken(true);
    expect($config->getPersistIdToken())->toBeTrue();

    $config->setPersistRefreshToken(false);
    expect($config->getPersistRefreshToken())->toBeFalse();
    $config->setPersistRefreshToken(true);
    expect($config->getPersistRefreshToken())->toBeTrue();

    $config->setPersistUser(false);
    expect($config->getPersistUser())->toBeFalse();
    $config->setPersistUser(true);
    expect($config->getPersistUser())->toBeTrue();
});

test('QueryUserInfo methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasQueryUserInfo())->toBeTrue();

    $config->setQueryUserInfo(false);
    expect($config->getQueryUserInfo())->toBeFalse();
    $config->setQueryUserInfo(true);
    expect($config->getQueryUserInfo())->toBeTrue();
});

test('RedirectUri methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mockDomain = MockDomain::valid();

    expect($config->hasRedirectUri())->toBeFalse();
    expect($config->getRedirectUri())->toBeNull();

    $config->setRedirectUri($mockDomain);
    expect($config->hasRedirectUri())->toBeTrue();
    expect($config->getRedirectUri())->toEqual($mockDomain);

    $config->setRedirectUri('   ');
    expect($config->hasRedirectUri())->toBeFalse();
    expect($config->getRedirectUri())->toBeNull();

    $config->setRedirectUri(str_pad($mockDomain, 30, ' ', STR_PAD_LEFT));
    expect($config->hasRedirectUri())->toBeTrue();
    expect($config->getRedirectUri())->toEqual($mockDomain);

    $config->setRedirectUri(null);
    expect($config->hasRedirectUri())->toBeFalse();
    expect($config->getRedirectUri())->toBeNull();

    $config->setRedirectUri(str_pad($mockDomain, 30, ' ', STR_PAD_RIGHT));
    expect($config->hasRedirectUri())->toBeTrue();
    expect($config->getRedirectUri())->toEqual($mockDomain);
});

test('getRedirectUri() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getRedirectUri(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('ResponseMode methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mock = uniqid();

    expect($config->hasResponseMode())->toBeTrue();
    expect($config->getResponseMode())->toEqual('query');

    $config->setResponseMode($mock);
    expect($config->hasResponseMode())->toBeTrue();
    expect($config->getResponseMode())->toEqual($mock);
});

test('setResponseMode() throws a ConfigurationException when an invalid mode is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setResponseMode(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'responseMode'));

test('ResponseType methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mock = uniqid();

    expect($config->hasResponseType())->toBeTrue();
    expect($config->getResponseType())->toEqual('code');

    $config->setResponseType($mock);
    expect($config->hasResponseType())->toBeTrue();
    expect($config->getResponseType())->toEqual($mock);
});

test('setResponseType() throws a ConfigurationException when an invalid mode is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setResponseType(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'responseType'));

test('Scope methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mock = uniqid();
    $default = ['openid', 'profile', 'email'];

    expect($config->hasScope())->toBeTrue();
    expect($config->getScope())->toEqual($default);

    $config->setScope(null);
    expect($config->getScope())->toEqual($default);

    $config->setScope([]);
    expect($config->getScope())->toEqual($default);

    $config->setScope([null]);
    expect($config->getScope())->toEqual($default);

    $config->setScope([null, null]);
    expect($config->getScope())->toEqual($default);

    $config->setScope([null, '', null]);
    expect($config->getScope())->toEqual($default);

    $config->setScope([$mock]);
    expect($config->getScope())->toEqual([$mock]);

    $config->setScope([$mock, null, $mock]);
    expect($config->getScope())->toEqual([$mock]);

    $config->setScope([$mock, null, $mock . 'x']);
    expect($config->getScope())->toEqual([$mock, $mock . 'x']);

    $config->setScope([]);
    expect($config->getScope())->toEqual($default);

    $config->pushScope('');
    expect($config->getScope())->toEqual($default);

    $config->pushScope([]);
    expect($config->getScope())->toEqual($default);

    $config->pushScope('123');
    expect($config->getScope())->toEqual(array_merge($default, ['123']));

    $config->pushScope([null, 456, null, '', 'test']);
    expect($config->getScope())->toEqual(array_merge($default, ['123', '456', 'test']));
});

test('SessionStorage methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $store = new MockStore();

    expect($config->hasSessionStorage())->toBeFalse();
    expect($config->getSessionStorage())->toBeNull();

    $config->setSessionStorage($store);
    expect($config->hasSessionStorage())->toBeTrue();
    expect($config->getSessionStorage())->toEqual($store);

    $config->setSessionStorage(null);
    expect($config->hasSessionStorage())->toBeFalse();
    expect($config->getSessionStorage())->toBeNull();
});

test('getSessionStorage() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getSessionStorage(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('SessionStorageId methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mock = uniqid();

    expect($config->hasSessionStorageId())->toBeTrue();
    expect($config->getSessionStorageId())->toEqual('auth0_session');

    $config->setSessionStorageId($mock);
    expect($config->hasSessionStorageId())->toBeTrue();
    expect($config->getSessionStorageId())->toEqual($mock);
});

test('setSessionStorageId() throws a ConfigurationException when an invalid value is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setSessionStorageId(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'sessionStorageId'));

test('Strategy methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasStrategy())->toBeTrue();
    expect($config->getStrategy())->toEqual(SdkConfiguration::STRATEGY_NONE);

    $config->setStrategy(SdkConfiguration::STRATEGY_API);
    expect($config->getStrategy())->toEqual(SdkConfiguration::STRATEGY_API);
});

test('setStrategy() throws a ConfigurationException when an invalid value is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setStrategy(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'strategy'));

test('TokenAlgorithm methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasTokenAlgorithm())->toBeTrue();
    expect($config->getTokenAlgorithm())->toEqual(Token::ALGO_RS256);

    $config->setTokenAlgorithm(TOken::ALGO_HS256);
    expect($config->getTokenAlgorithm())->toEqual(Token::ALGO_HS256);
});

test('setTokenAlgorithm() throws a ConfigurationException when an invalid value is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setTokenAlgorithm(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, ConfigurationException::MSG_INVALID_TOKEN_ALGORITHM);

test('TokenCache methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $cache = new ArrayAdapter();

    expect($config->hasTokenCache())->toBeFalse();
    expect($config->getTokenCache())->toBeNull();

    $config->setTokenCache($cache);
    expect($config->hasTokenCache())->toBeTrue();
    expect($config->getTokenCache())->toEqual($cache);
});

test('getTokenCache() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getTokenCache(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('TokenCacheTtl methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasTokenCacheTtl())->toBeTrue();
    expect($config->getTokenCacheTtl())->toEqual(60);

    $config->setTokenCacheTtl(0);
    expect($config->hasTokenCacheTtl())->toBeTrue();
    expect($config->getTokenCacheTtl())->toEqual(0);

    $config->setTokenCacheTtl(100);
    expect($config->hasTokenCacheTtl())->toBeTrue();
    expect($config->getTokenCacheTtl())->toEqual(100);
});

test('setTokenCacheTtl() throws a ConfigurationException when a negative value is provided', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->setTokenCacheTtl(-100);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'tokenCacheTtl'));

test('TokenJwksUri methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    expect($config->hasTokenJwksUri())->toBeFalse();
    expect($config->getTokenJwksUri())->toBeNull();

    $config->setTokenJwksUri('test.com');
    expect($config->hasTokenJwksUri())->toBeTrue();
    expect($config->getTokenJwksUri())->toEqual('test.com');

    $config->setTokenJwksUri('   ');
    expect($config->hasTokenJwksUri())->toBeFalse();
    expect($config->getTokenJwksUri())->toBeNull();

    $config->setTokenJwksUri('   test.com');
    expect($config->hasTokenJwksUri())->toBeTrue();
    expect($config->getTokenJwksUri())->toEqual('test.com');

    $config->setTokenJwksUri(null);
    expect($config->hasTokenJwksUri())->toBeFalse();
    expect($config->getTokenJwksUri())->toBeNull();

    $config->setTokenJwksUri('test.com  ');
    expect($config->hasTokenJwksUri())->toBeTrue();
    expect($config->getTokenJwksUri())->toEqual('test.com');
});

test('getTokenJwksUri() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getTokenJwksUri(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('TokenLeeway methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasTokenLeeway())->toBeTrue();
    expect($config->getTokenLeeway())->toEqual(60);

    $config->setTokenLeeway(0);
    expect($config->hasTokenLeeway())->toBeTrue();
    expect($config->getTokenLeeway())->toEqual(0);

    $config->setTokenLeeway(100);
    expect($config->hasTokenLeeway())->toBeTrue();
    expect($config->getTokenLeeway())->toEqual(100);
});

test('setTokenLeeway() throws a ConfigurationException when a negative value is provided', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->setTokenLeeway(-100);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'tokenLeeway'));

test('TokenMaxAge methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasTokenMaxAge())->toBeFalse();
    expect($config->getTokenMaxAge())->toBeNull();

    $config->setTokenMaxAge(0);
    expect($config->hasTokenLeeway())->toBeTrue();
    expect($config->getTokenMaxAge())->toEqual(0);

    $config->setTokenMaxAge(null);
    expect($config->hasTokenMaxAge())->toBeFalse();
    expect($config->getTokenMaxAge())->toBeNull();

    $config->setTokenMaxAge(100);
    expect($config->hasTokenMaxAge())->toBeTrue();
    expect($config->getTokenMaxAge())->toEqual(100);
});

test('setTokenMaxAge() throws a ConfigurationException when a negative value is provided', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $config->setTokenMaxAge(-100);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'tokenMaxAge'));

test('TransientStorage methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $store = new MockStore();

    expect($config->hasTransientStorage())->toBeFalse();
    expect($config->getTransientStorage())->toBeNull();

    $config->setTransientStorage($store);
    expect($config->hasTransientStorage())->toBeTrue();
    expect($config->getTransientStorage())->toEqual($store);

    $config->setTransientStorage(null);
    expect($config->hasTransientStorage())->toBeFalse();
    expect($config->getTransientStorage())->toBeNull();
});

test('getTransientStorage() throws an assigned exception when not configured', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->getTransientStorage(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('TransientStorageId methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $mock = uniqid();

    expect($config->hasTransientStorageId())->toBeTrue();
    expect($config->getTransientStorageId())->toEqual('auth0_transient');

    $config->setTransientStorageId($mock);
    expect($config->hasTransientStorageId())->toBeTrue();
    expect($config->getTransientStorageId())->toEqual($mock);
});

test('setTransientStorageId() throws a ConfigurationException when an invalid value is provided', function(): void
{
    $config = new SdkConfiguration([
        'strategy' => SdkConfiguration::STRATEGY_NONE
    ]);

    $config->setTransientStorageId(str_pad('', 30, ' ', STR_PAD_RIGHT));
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'transientStorageId'));

test('Pkce methods function as expected', function(): void
{
    $config = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    expect($config->hasUsePkce())->toBeTrue();

    $config->setUsePkce(false);
    expect($config->getUsePkce())->toBeFalse();
    $config->setUsePkce(true);
    expect($config->getUsePkce())->toBeTrue();
});
