<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;

uses()->group('authentication');

beforeEach(function(): void {
    $this->configuration = new SdkConfiguration([
        'domain' => 'https://test-domain.auth0.com',
        'clientId' => '__test_client_id__',
        'redirectUri' => 'https://some-app.auth0.com',
        'audience' => ['aud1', 'aud2', 'aud3'],
        'scope' => ['scope1', 'scope2', 'scope3'],
        'organization' => ['org1', 'org2', 'org3'],
    ]);

    $this->sdk = new Auth0($this->configuration);
});

test('__construct() fails without a configuration', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_CONFIGURATION_REQUIRED);

    new Authentication(null);
});

test('__construct() successfully loads an inherited configuration', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLoginLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
});

test('__construct() successfully loads a direct configuration', function(): void {
    $class = new Authentication($this->configuration);
    $uri = $class->getLoginLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
});

test('getAuthorizationLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getAuthorizationLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('client_id=' . rawurlencode($this->configuration->getClientId()), $uri);
    $this->assertStringContainsString('response_type=' . rawurlencode($this->configuration->getResponseType()), $uri);
    $this->assertStringContainsString('redirect_uri=' . rawurlencode($this->configuration->getRedirectUri()), $uri);
    $this->assertStringContainsString('audience=' . rawurlencode($this->configuration->buildDefaultAudience()), $uri);
    $this->assertStringContainsString('scope=' . rawurlencode($this->configuration->buildScopeString()), $uri);
    $this->assertStringContainsString('organization=' . rawurlencode($this->configuration->buildDefaultOrganization()), $uri);

    $exampleScope = uniqid();
    $uri = $class->getAuthorizationLink([
        'scope' => $exampleScope
    ]);

    $this->assertStringContainsString('scope=' . rawurlencode($exampleScope), $uri);
});

test('getSamlpLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getSamlpLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('/samlp/' . rawurlencode($this->configuration->getClientId()) . '?', $uri);

    $exampleClientId = uniqid();
    $exampleConnection = uniqid();
    $uri = $class->getSamlpLink($exampleClientId, $exampleConnection);

    $this->assertStringContainsString('/samlp/' . rawurlencode($exampleClientId) . '?', $uri);
    $this->assertStringContainsString('connection=' . rawurlencode($exampleConnection), $uri);
});

test('getSamlpMetadataLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getSamlpMetadataLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('/samlp/metadata/' . rawurlencode($this->configuration->getClientId()), $uri);

    $exampleClientId = uniqid();
    $uri = $class->getSamlpMetadataLink($exampleClientId);

    $this->assertStringContainsString('/samlp/metadata/' . rawurlencode($exampleClientId), $uri);
});

test('getWsfedLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getWsfedLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('/wsfed/' . rawurlencode($this->configuration->getClientId()) . '?', $uri);

    $exampleClientId = uniqid();
    $exampleParam = uniqid();
    $uri = $class->getWsfedLink($exampleClientId, ['whr' => $exampleParam]);

    $this->assertStringContainsString('/wsfed/' . rawurlencode($exampleClientId) . '?', $uri);
    $this->assertStringContainsString('whr=' . rawurlencode($exampleParam), $uri);
});

test('getWsfedMetadataLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getWsfedMetadataLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('/wsfed/FederationMetadata/2007-06/FederationMetadata.xml', $uri);
});

test('getLogoutLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLogoutLink();

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('returnTo=' . rawurlencode($this->configuration->getRedirectUri()), $uri);

    $exampleReturnTo = uniqid();
    $exampleParam = uniqid();
    $uri = $class->getLogoutLink($exampleReturnTo, ['ex' => $exampleParam]);

    $this->assertStringContainsString('returnTo=' . rawurlencode($exampleReturnTo), $uri);
    $this->assertStringContainsString('ex=' . rawurlencode($exampleParam), $uri);
});
