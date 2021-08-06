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

    $this->assertEquals($domain, $sdk->getDomain());
    $this->assertEquals($clientId, $sdk->getClientId());
    $this->assertEquals($redirectUri, $sdk->getRedirectUri());
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

    $this->assertEquals($domain, $sdk->getDomain());
});

test('__construct() does not accept invalid types from configuration array', function(): void
{
    $randomNumber = mt_rand();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_SET_INCOMPATIBLE_NULLABLE, 'domain', 'string', 'integer'));

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

    $this->assertEquals('test.auth0.com', $sdk->getDomain());
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
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ConfigurationException::MSG_VALIDATION_FAILED, 'tokenLeeway'));

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenLeeway' => 'TEST'
    ]);
});

test('__construct() converts token leeway passed as a string into an int silently', function(): void {
    $domain = uniqid();
    $cookieSecret = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'cookieSecret' => $cookieSecret,
        'clientId' => $clientId,
        'redirectUri' => $redirectUri,
        'tokenLeeway' => '300'
    ]);

    $this->assertEquals(300, $sdk->getTokenLeeway());
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

    $this->assertEquals($domain1, $sdk->getDomain());
    $this->assertEquals($cookieSecret1, $sdk->getCookieSecret());
    $this->assertEquals($clientId1, $sdk->getClientId());
    $this->assertEquals($redirectUri1, $sdk->getRedirectUri());

    $sdk->setDomain($domain2);
    $sdk->setCookieSecret($cookieSecret2);
    $sdk->setClientId($clientId2);
    $sdk->setRedirectUri($redirectUri2);

    $this->assertEquals($domain2, $sdk->getDomain());
    $this->assertEquals($cookieSecret2, $sdk->getCookieSecret());
    $this->assertEquals($clientId2, $sdk->getClientId());
    $this->assertEquals($redirectUri2, $sdk->getRedirectUri());
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

    $this->assertEquals($domain, $sdk->getDomain());
    $this->assertFalse($sdk->getUsePkce());

    $sdk->reset();

    $this->assertEquals(null, $sdk->getDomain());
    $this->assertTrue($sdk->getUsePkce());
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

    $this->assertEquals('https://' . $domain, $sdk->formatDomain());
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

    $this->assertEquals('', $sdk->formatScope());
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

    $this->assertEquals('one two three', $sdk->formatScope());
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

    $this->assertEquals('org1', $sdk->defaultOrganization());
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

    $this->assertEquals('aud1', $sdk->defaultAudience());
});
