<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;

uses()->group('authentication');

beforeEach(function(): void {
    // Allow mock HttpClient to be auto-discovered for use in testing.
    Psr18ClientDiscovery::prependStrategy(MockClientStrategy::class);

    $this->configuration = new SdkConfiguration([
        'domain' => 'https://test-domain.auth0.com',
        'cookieSecret' => uniqid(),
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

test('__construct() accepts a configuration as an array', function(): void {
    $auth = new Authentication([
        'strategy' => 'api',
        'domain' => uniqid(),
        'audience' => [uniqid()]
    ]);

    $this->assertInstanceOf(Authentication::class, $auth);
});

test('__construct() successfully loads an inherited configuration', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLoginLink(uniqid());

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
});

test('__construct() successfully loads a direct configuration', function(): void {
    $class = new Authentication($this->configuration);
    $uri = $class->getLoginLink(uniqid());

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
});

test('getLoginLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLoginLink(uniqid());

    $this->assertStringContainsString($this->configuration->getDomain(), $uri);
    $this->assertStringContainsString('client_id=' . rawurlencode($this->configuration->getClientId()), $uri);
    $this->assertStringContainsString('response_type=' . rawurlencode($this->configuration->getResponseType()), $uri);
    $this->assertStringContainsString('redirect_uri=' . rawurlencode($this->configuration->getRedirectUri()), $uri);
    $this->assertStringContainsString('audience=' . rawurlencode($this->configuration->defaultAudience()), $uri);
    $this->assertStringContainsString('scope=' . rawurlencode($this->configuration->formatScope()), $uri);
    $this->assertStringContainsString('organization=' . rawurlencode($this->configuration->defaultOrganization()), $uri);

    $exampleScope = uniqid();
    $uri = $class->getLoginLink(uniqid(), null, [
        'scope' => $exampleScope,
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

test('passwordlessStart() throws a ConfigurationException if client secret is not configured', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

    $this->sdk->authentication()->passwordlessStart();
});

test('passwordlessStart() throws a ConfigurationException if client id is not configured', function(): void {
    $this->configuration->setClientId(null);

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_CLIENT_ID);

    $this->sdk->authentication()->passwordlessStart();
});

test('passwordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->passwordlessStart();

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/passwordless/start', $requestUri->getPath());
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    $this->assertEquals($this->configuration->getClientId(), $requestBody['client_id']);
    $this->assertEquals($this->configuration->getClientSecret(), $requestBody['client_secret']);
});

test('emailPasswordlessStart() throws an ArgumentException if `email` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'email'));

    $this->sdk->authentication()->emailPasswordlessStart('', '');
});

test('emailPasswordlessStart() throws an ArgumentException if `email` is not a valid email address', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'email'));

    $this->sdk->authentication()->emailPasswordlessStart(uniqid(), '');
});

test('emailPasswordlessStart() throws an ArgumentException if `type` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'type'));

    $this->sdk->authentication()->emailPasswordlessStart('someone@somewhere.somehow', '');
});

test('emailPasswordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->emailPasswordlessStart('someone@somewhere.somehow   ', 'code');

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/passwordless/start', $requestUri->getPath());
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('send', $requestBody);
    $this->assertEquals($this->configuration->getClientId(), $requestBody['client_id']);
    $this->assertEquals($this->configuration->getClientSecret(), $requestBody['client_secret']);
    $this->assertEquals('email', $requestBody['connection']);
    $this->assertEquals('someone@somewhere.somehow', $requestBody['email']);
    $this->assertEquals('code', $requestBody['send']);
});

test('smsPasswordlessStart() throws an ArgumentException if `phoneNumber` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'phoneNumber'));

    $this->sdk->authentication()->smsPasswordlessStart('');
});

test('smsPasswordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->smsPasswordlessStart('   8675309');

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/passwordless/start', $requestUri->getPath());
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('phone_number', $requestBody);
    $this->assertEquals($this->configuration->getClientId(), $requestBody['client_id']);
    $this->assertEquals($this->configuration->getClientSecret(), $requestBody['client_secret']);
    $this->assertEquals('sms', $requestBody['connection']);
    $this->assertEquals('8675309', $requestBody['phone_number']);
});

test('userInfo() is properly formatted', function(): void {
    $accessToken = uniqid();

    $this->sdk->authentication()->userInfo($accessToken);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/userinfo', $requestUri->getPath());
    $this->assertArrayHasKey('Authorization', $requestHeaders);
    $this->assertEquals('Bearer ' . $accessToken, $requestHeaders['Authorization'][0]);
});

test('oauthToken() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->oauthToken('authorization_code');

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=authorization_code', $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
});

test('codeExchange() is properly formatted', function(): void {
    $clientSecret = uniqid();
    $code = uniqid();
    $redirect = uniqid();
    $verifier = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->codeExchange($code, $redirect, $verifier);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=authorization_code', $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
    $this->assertContains('code=' . $code, $requestBody);
    $this->assertContains('redirect_uri=' . $redirect, $requestBody);
    $this->assertContains('code_verifier=' . $verifier, $requestBody);
});

test('login() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $username = uniqid();
    $password = uniqid();
    $realm = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->login($username, $password, $realm);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=' . urlencode('http://auth0.com/oauth/grant-type/password-realm'), $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
    $this->assertContains('username=' . $username, $requestBody);
    $this->assertContains('password=' . $password, $requestBody);
    $this->assertContains('realm=' . $realm, $requestBody);
});

test('loginWithDefaultDirectory() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $username = uniqid();
    $password = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->loginWithDefaultDirectory($username, $password);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=password', $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
    $this->assertContains('username=' . $username, $requestBody);
    $this->assertContains('password=' . $password, $requestBody);
});

test('clientCredentials() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->clientCredentials(['testing' => 123], ['header_testing' => 123]);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());
    $requestHeaders = $request->getHeaders();

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=client_credentials', $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
    $this->assertContains('audience=aud1', $requestBody);
    $this->assertContains('testing=123', $requestBody);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    $this->assertEquals(123, $requestHeaders['header_testing'][0]);
});

test('refreshToken() is properly formatted', function(): void {
    $clientSecret = uniqid();
    $refreshToken = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->refreshToken($refreshToken, ['testing' => 123], ['header_testing' => 123]);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());
    $requestHeaders = $request->getHeaders();

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/oauth/token', $requestUri->getPath());

    $this->assertContains('grant_type=refresh_token', $requestBody);
    $this->assertContains('client_id=__test_client_id__', $requestBody);
    $this->assertContains('client_secret=' . $clientSecret, $requestBody);
    $this->assertContains('refresh_token=' . $refreshToken, $requestBody);
    $this->assertContains('testing=123', $requestBody);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    $this->assertEquals(123, $requestHeaders['header_testing'][0]);
});

test('dbConnectionsSignup() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $email = 'someone@somewhere.somehow   ';
    $password = uniqid();
    $connection = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->dbConnectionsSignup($email, $password, $connection, ['testing' => 123], ['header_testing' => 123]);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/dbconnections/signup', $requestUri->getPath());

    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('password', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('testing', $requestBody);

    $this->assertEquals('__test_client_id__', $requestBody['client_id']);
    $this->assertEquals(trim($email), $requestBody['email']);
    $this->assertEquals($password, $requestBody['password']);
    $this->assertEquals($connection, $requestBody['connection']);
    $this->assertEquals(123, $requestBody['testing']);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    $this->assertEquals(123, $requestHeaders['header_testing'][0]);
});

test('dbConnectionsChangePassword() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $email = '    someone@somewhere.somehow';
    $connection = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $this->sdk->authentication()->dbConnectionsChangePassword($email, $connection, ['testing' => 123], ['header_testing' => 123]);

    $request = $this->sdk->authentication()->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    $this->assertEquals($this->configuration->getDomain(), $requestUri->getHost());
    $this->assertEquals('/dbconnections/change_password', $requestUri->getPath());

    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('testing', $requestBody);

    $this->assertEquals('__test_client_id__', $requestBody['client_id']);
    $this->assertEquals(trim($email), $requestBody['email']);
    $this->assertEquals($connection, $requestBody['connection']);
    $this->assertEquals(123, $requestBody['testing']);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    $this->assertEquals(123, $requestHeaders['header_testing'][0]);
});
