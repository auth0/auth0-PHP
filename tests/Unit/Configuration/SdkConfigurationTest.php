<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;

uses()->group('configuration');

test('__construct() throws an error when domain is not configured', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_MISSING_DOMAIN);

    $sdk = new SdkConfiguration();
});

test('__construct() throws an error when clientId is not configured', function(): void {
    $domain = uniqid();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_MISSING_CLIENT_ID);

    $sdk = new SdkConfiguration([
        'domain' => $domain
    ]);
});

test('__construct() throws an error when redirectUri is not configured', function(): void {
    $domain = uniqid();
    $clientId = uniqid();

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_MISSING_REDIRECT_URI);

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'clientId' => $clientId
    ]);
});

test('__construct() accepts a configuration array', function(): void {
    $domain = uniqid();
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
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
    $clientId = uniqid();
    $redirectUri = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
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

    $sdk = new SdkConfiguration([
        'domain' => $randomNumber
    ]);
});

test('__construct() successfully only stores the host when passed a full uri as `domain`', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => 'https://test.auth0.com/.example-path/nonsense.txt',
        'clientId' => uniqid(),
        'redirectUri' => uniqid()
    ]);

    $this->assertEquals('test.auth0.com', $sdk->getDomain());
});

test('successfully updates values', function(): void
{
    $domain1 = uniqid();
    $clientId1 = uniqid();
    $redirectUri1 = uniqid();

    $domain2 = uniqid();
    $clientId2 = uniqid();
    $redirectUri2 = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain1,
        'clientId' => $clientId1,
        'redirectUri' => $redirectUri1,
    ]);

    $this->assertEquals($domain1, $sdk->getDomain());
    $this->assertEquals($clientId1, $sdk->getClientId());
    $this->assertEquals($redirectUri1, $sdk->getRedirectUri());

    $sdk->setDomain($domain2);
    $sdk->setClientId($clientId2);
    $sdk->setRedirectUri($redirectUri2);

    $this->assertEquals($domain2, $sdk->getDomain());
    $this->assertEquals($clientId2, $sdk->getClientId());
    $this->assertEquals($redirectUri2, $sdk->getRedirectUri());
});

test('successfully resets values', function(): void
{
    $domain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
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

test('buildDomainUri() returns a properly formatted uri', function(): void
{
    $domain = uniqid();

    $sdk = new SdkConfiguration([
        'domain' => $domain,
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
    ]);

    $this->assertEquals('https://' . $domain, $sdk->buildDomainUri());
});

test('buildScopeString() successfully converts the array to a string', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'scope' => ['one', 'two', 'three'],
    ]);

    $this->assertEquals('one two three', $sdk->buildScopeString());
});

test('buildDefaultOrganization() successfully returns the first organization', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'organization' => ['org1', 'org2', 'org3'],
    ]);

    $this->assertEquals('org1', $sdk->buildDefaultOrganization());
});

test('buildDefaultAudience() successfully returns the first audience', function(): void
{
    $sdk = new SdkConfiguration([
        'domain' => uniqid(),
        'clientId' => uniqid(),
        'redirectUri' => uniqid(),
        'audience' => ['aud1', 'aud2', 'aud3'],
    ]);

    $this->assertEquals('aud1', $sdk->buildDefaultAudience());
});
