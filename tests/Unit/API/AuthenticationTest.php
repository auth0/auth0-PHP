<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Authentication\PushedAuthorizationRequest;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\ArgumentException;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockDomain;
use Auth0\Tests\Utilities\TokenGenerator;

uses()->group('authentication');

beforeEach(function(): void {
    $this->configuration = new SdkConfiguration([
        'domain' => MockDomain::valid(),
        'cookieSecret' => uniqid(),
        'clientId' => '__test_client_id__',
        'redirectUri' => 'https://some-app.auth0.com',
        'audience' => ['aud1', 'aud2', 'aud3'],
        'scope' => ['scope1', 'scope2', 'scope3'],
        'organization' => ['org1', 'org2', 'org3'],
    ]);

    $this->sdk = new Auth0($this->configuration);
});

test('__construct() accepts a configuration as an array', function(): void {
    $auth = new Authentication([
        'strategy' => SdkConfiguration::STRATEGY_API,
        'domain' => MockDomain::valid(),
        'audience' => [uniqid()]
    ]);

    expect($auth)->toBeInstanceOf(Authentication::class);
});

test('__construct() successfully loads an inherited configuration', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLoginLink(uniqid());

    expect($uri)->toContain($this->configuration->getDomain());
});

test('__construct() successfully loads a direct configuration', function(): void {
    $class = new Authentication($this->configuration);
    $uri = $class->getLoginLink(uniqid());

    expect($uri)->toContain($this->configuration->getDomain());
});

test('addClientAuthentication() inserts `client_id` and `client_secret` properties when configured', function(): void {
    $secret = uniqid();

    $this->configuration->setClientSecret($secret);

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->passwordlessStart();

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestBody)
        ->toBeArray()
        ->toHaveKeys(['client_id', 'client_secret'])
        ->client_id->toEqual($this->configuration->getClientId())
        ->client_secret->toEqual($secret)
        ->not()->toHaveKeys(['client_assertion', 'client_assertion_type']);
});

test('addClientAuthentication() inserts correct client assertion properties when configured', function(): void {
    $secret = TokenGenerator::generateRsaKeyPair();

    $this->configuration->setClientAssertionSigningKey($secret['private']);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->passwordlessStart();

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestBody)
        ->toBeArray()
        ->toHaveKeys(['client_id', 'client_assertion_type', 'client_assertion'])
        ->client_id->toEqual($this->configuration->getClientId())
        ->client_assertion_type->toEqual(Authentication::CONST_CLIENT_ASSERTION_TYPE)
        ->client_assertion->not->toBeEmpty()
        ->not()->toHaveKey('client_secret');
});

test('getLoginLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLoginLink(uniqid());

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('client_id=' . rawurlencode($this->configuration->getClientId()));
    expect($uri)->toContain('response_type=' . rawurlencode($this->configuration->getResponseType()));
    expect($uri)->toContain('redirect_uri=' . rawurlencode($this->configuration->getRedirectUri()));
    expect($uri)->toContain('audience=' . rawurlencode($this->configuration->defaultAudience()));
    expect($uri)->toContain('scope=' . rawurlencode($this->configuration->formatScope()));
    expect($uri)->toContain('organization=' . rawurlencode($this->configuration->defaultOrganization()));

    $exampleScope = uniqid();
    $uri = $class->getLoginLink(uniqid(), null, [
        'scope' => $exampleScope,
    ]);

    expect($uri)->toContain('scope=' . rawurlencode($exampleScope));
});

test('getSamlpLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getSamlpLink();

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('/samlp/' . rawurlencode($this->configuration->getClientId()) . '?');

    $exampleClientId = uniqid();
    $exampleConnection = uniqid();
    $uri = $class->getSamlpLink($exampleClientId, $exampleConnection);

    expect($uri)->toContain('/samlp/' . rawurlencode($exampleClientId) . '?');
    expect($uri)->toContain('connection=' . rawurlencode($exampleConnection));
});

test('getSamlpMetadataLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getSamlpMetadataLink();

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('/samlp/metadata/' . rawurlencode($this->configuration->getClientId()));

    $exampleClientId = uniqid();
    $uri = $class->getSamlpMetadataLink($exampleClientId);

    expect($uri)->toContain('/samlp/metadata/' . rawurlencode($exampleClientId));
});

test('getWsfedLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getWsfedLink();

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('/wsfed/' . rawurlencode($this->configuration->getClientId()) . '?');

    $exampleClientId = uniqid();
    $exampleParam = uniqid();
    $uri = $class->getWsfedLink($exampleClientId, ['whr' => $exampleParam]);

    expect($uri)->toContain('/wsfed/' . rawurlencode($exampleClientId) . '?');
    expect($uri)->toContain('whr=' . rawurlencode($exampleParam));
});

test('getWsfedMetadataLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getWsfedMetadataLink();

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('/wsfed/FederationMetadata/2007-06/FederationMetadata.xml');
});

test('getLogoutLink() is properly formatted', function(): void {
    $class = $this->sdk->authentication();
    $uri = $class->getLogoutLink();

    expect($uri)->toContain($this->configuration->getDomain());
    expect($uri)->toContain('returnTo=' . rawurlencode($this->configuration->getRedirectUri()));

    $exampleReturnTo = uniqid();
    $exampleParam = uniqid();
    $uri = $class->getLogoutLink($exampleReturnTo, ['ex' => $exampleParam]);

    expect($uri)->toContain('returnTo=' . rawurlencode($exampleReturnTo));
    expect($uri)->toContain('ex=' . rawurlencode($exampleParam));
});

test('passwordlessStart() throws a ConfigurationException if client secret is not configured', function(): void {
    $this->sdk->authentication()->passwordlessStart();
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_SECRET);

test('passwordlessStart() throws a ConfigurationException if client id is not configured', function(): void {
    $this->configuration->setClientId(null);
    $this->sdk->authentication()->passwordlessStart();
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_CLIENT_ID);

test('passwordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->passwordlessStart();

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/passwordless/start');
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    expect($requestBody['client_id'])->toEqual($this->configuration->getClientId());
    expect($requestBody['client_secret'])->toEqual($this->configuration->getClientSecret());
});

test('emailPasswordlessStart() throws an ArgumentException if `email` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->emailPasswordlessStart('', '');
})->throws(ArgumentException::class, sprintf(ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'email'));

test('emailPasswordlessStart() throws an ArgumentException if `email` is not a valid email address', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->emailPasswordlessStart(uniqid(), '');
})->throws(ArgumentException::class, sprintf(ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'email'));

test('emailPasswordlessStart() throws an ArgumentException if `type` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->sdk->authentication()->emailPasswordlessStart('someone@somewhere.somehow', '');
})->throws(ArgumentException::class, sprintf(ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'type'));

test('emailPasswordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->emailPasswordlessStart('someone@somewhere.somehow   ', 'code');

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/passwordless/start');
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('send', $requestBody);
    expect($requestBody['client_id'])->toEqual($this->configuration->getClientId());
    expect($requestBody['client_secret'])->toEqual($this->configuration->getClientSecret());
    expect($requestBody['connection'])->toEqual('email');
    expect($requestBody['email'])->toEqual('someone@somewhere.somehow');
    expect($requestBody['send'])->toEqual('code');
});

test('emailPasswordlessStart() returns authParams with default configured scopes when none are provided', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->emailPasswordlessStart('someone@somewhere.somehow', 'code');

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), false);

    expect($requestBody)->toHaveProperties(['authParams']);
    expect($requestBody->authParams)->toBeObject()->toHaveProperties(['scope']);
    expect($requestBody->authParams->scope)->toEqual('scope1 scope2 scope3');
});

test('emailPasswordlessStart() returns authParams with default configured scopes when an empty array is configured', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->emailPasswordlessStart('someone@somewhere.somehow', 'code', []);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), false);

    expect($requestBody)->toHaveProperties(['authParams']);
    expect($requestBody->authParams)->toBeObject()->toHaveProperties(['scope']);
    expect($requestBody->authParams->scope)->toEqual('scope1 scope2 scope3');
});

test('emailPasswordlessStart() returns authParams correctly configured when provided', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->emailPasswordlessStart('someone@somewhere.somehow', 'code', ['scope' => 'test1 test2']);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), false);

    expect($requestBody)->toHaveProperties(['authParams']);
    expect($requestBody->authParams)->toBeObject()->toHaveProperties(['scope']);
    expect($requestBody->authParams->scope)->toEqual('test1 test2');
});

test('smsPasswordlessStart() throws an ArgumentException if `phoneNumber` is empty', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->smsPasswordlessStart('');
})->throws(ArgumentException::class, sprintf(ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'phoneNumber'));

test('smsPasswordlessStart() is properly formatted', function(): void {
    $this->configuration->setClientSecret(uniqid());

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->smsPasswordlessStart('   8675309');

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/passwordless/start');
    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('client_secret', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('phone_number', $requestBody);
    expect($requestBody['client_id'])->toEqual($this->configuration->getClientId());
    expect($requestBody['client_secret'])->toEqual($this->configuration->getClientSecret());
    expect($requestBody['connection'])->toEqual('sms');
    expect($requestBody['phone_number'])->toEqual('8675309');
});

test('userInfo() is properly formatted', function(): void {
    $accessToken = uniqid();

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->userInfo($accessToken);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/userinfo');
    $this->assertArrayHasKey('Authorization', $requestHeaders);
    expect($requestHeaders['Authorization'][0])->toEqual('Bearer ' . $accessToken);
});

test('oauthToken() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->oauthToken('authorization_code');

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=authorization_code');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
});

test('codeExchange() is properly formatted', function(): void {
    $clientSecret = uniqid();
    $code = uniqid();
    $redirect = uniqid();
    $verifier = uniqid();

    $this->configuration->setClientSecret($clientSecret);

    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->codeExchange($code, $redirect, $verifier);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=authorization_code');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('code=' . $code);
    expect($requestBody)->toContain('redirect_uri=' . $redirect);
    expect($requestBody)->toContain('code_verifier=' . $verifier);
});

test('login() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $username = uniqid();
    $password = uniqid();
    $realm = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->login($username, $password, $realm);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=' . urlencode('http://auth0.com/oauth/grant-type/password-realm'));
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('username=' . $username);
    expect($requestBody)->toContain('password=' . $password);
    expect($requestBody)->toContain('realm=' . $realm);
});

test('loginWithDefaultDirectory() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $username = uniqid();
    $password = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->loginWithDefaultDirectory($username, $password);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=password');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('username=' . $username);
    expect($requestBody)->toContain('password=' . $password);
});

test('clientCredentials() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->clientCredentials(['testing' => 123], ['header_testing' => 123]);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=client_credentials');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('audience=aud1');
    expect($requestBody)->toContain('testing=123');

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    expect($requestHeaders['header_testing'][0])->toEqual(123);
});

test('clientCredentials() includes organization in request when configured', function(): void {
    $clientSecret = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->clientCredentials(['organization' => 'org_xyz'], ['header_testing' => 123]);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=client_credentials');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('audience=aud1');
    expect($requestBody)->toContain('organization=org_xyz');

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    expect($requestHeaders['header_testing'][0])->toEqual(123);
});

test('refreshToken() is properly formatted', function(): void {
    $clientSecret = uniqid();
    $refreshToken = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->refreshToken($refreshToken, ['testing' => 123], ['header_testing' => 123]);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody =  explode('&', $request->getBody()->__toString());
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/oauth/token');

    expect($requestBody)->toContain('grant_type=refresh_token');
    expect($requestBody)->toContain('client_id=__test_client_id__');
    expect($requestBody)->toContain('client_secret=' . $clientSecret);
    expect($requestBody)->toContain('refresh_token=' . $refreshToken);
    expect($requestBody)->toContain('testing=123');

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    expect($requestHeaders['header_testing'][0])->toEqual(123);
});

test('dbConnectionsSignup() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $email = 'someone@somewhere.somehow   ';
    $password = uniqid();
    $connection = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->dbConnectionsSignup($email, $password, $connection, ['testing' => 123], ['header_testing' => 123]);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/dbconnections/signup');

    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('password', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('testing', $requestBody);

    expect($requestBody['client_id'])->toEqual('__test_client_id__');
    expect($requestBody['email'])->toEqual(trim($email));
    expect($requestBody['password'])->toEqual($password);
    expect($requestBody['connection'])->toEqual($connection);
    expect($requestBody['testing'])->toEqual(123);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    expect($requestHeaders['header_testing'][0])->toEqual(123);
});

test('dbConnectionsSignup handles phone_number correctly', function (): void {
    $clientSecret = uniqid();
    $email = 'someone@somewhere.somehow';
    $password = uniqid();
    $connection = uniqid();
    $phoneNumber = '+1234567890';

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);

    // Test with phone_number
    $authentication->dbConnectionsSignup($email, $password, $connection, ['phone_number' => $phoneNumber]);
    $requestWithPhone = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBodyWithPhone = json_decode($requestWithPhone->getBody()->__toString(), true);

    $this->assertArrayHasKey('phone_number', $requestBodyWithPhone);
    expect($requestBodyWithPhone['phone_number'])->toEqual($phoneNumber);

    // Test without phone_number
    $authentication->dbConnectionsSignup($email, $password, $connection);
    $requestWithoutPhone = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBodyWithoutPhone = json_decode($requestWithoutPhone->getBody()->__toString(), true);

    $this->assertArrayNotHasKey('phone_number', $requestBodyWithoutPhone);
});

test('dbConnectionsSignup handles flexible identifiers and precedence', function (): void {
    $clientSecret = uniqid();
    $email = 'someone@somewhere.somehow';
    $password = uniqid();
    $connection = uniqid();
    $phoneNumber = '+1234567890';

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);

    $authentication->dbConnectionsSignup($email, $password, $connection, ['phone_number' => $phoneNumber]);
    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBody = json_decode($request->getBody()->__toString(), true);

    expect($requestBody['email'])->toEqual($email);
    expect($requestBody['phone_number'])->toEqual($phoneNumber);
});

test('dbConnectionsChangePassword() is properly formatted', function(): void {
    $clientSecret = uniqid();

    $email = '    someone@somewhere.somehow';
    $connection = uniqid();

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);
    $authentication->dbConnectionsChangePassword($email, $connection, ['testing' => 123], ['header_testing' => 123]);

    $request = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestUri = $request->getUri();
    $requestBody = json_decode($request->getBody()->__toString(), true);
    $requestHeaders = $request->getHeaders();

    expect($requestUri->getHost())->toEqual($this->configuration->getDomain());
    expect($requestUri->getPath())->toEqual('/dbconnections/change_password');

    $this->assertArrayHasKey('client_id', $requestBody);
    $this->assertArrayHasKey('email', $requestBody);
    $this->assertArrayHasKey('connection', $requestBody);
    $this->assertArrayHasKey('testing', $requestBody);

    expect($requestBody['client_id'])->toEqual('__test_client_id__');
    expect($requestBody['email'])->toEqual(trim($email));
    expect($requestBody['connection'])->toEqual($connection);
    expect($requestBody['testing'])->toEqual(123);

    $this->assertArrayHasKey('header_testing', $requestHeaders);
    expect($requestHeaders['header_testing'][0])->toEqual(123);
});

test('dbConnectionsChangePassword handles phone_number correctly', function (): void {
    $clientSecret = uniqid();

    $email = 'someone@somewhere.somehow';
    $connection = uniqid();
    $phoneNumber = '+1234567890';

    $this->configuration->setClientSecret($clientSecret);
    $authentication = $this->sdk->authentication();
    $authentication->getHttpClient()->mockResponses([HttpResponseGenerator::create()]);

    // Test with phone_number
    $authentication->dbConnectionsChangePassword($email, $connection, ['phone_number' => $phoneNumber]);
    $requestWithPhone = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBodyWithPhone = json_decode($requestWithPhone->getBody()->__toString(), true);

    $this->assertArrayHasKey('phone_number', $requestBodyWithPhone);
    expect($requestBodyWithPhone['phone_number'])->toEqual($phoneNumber);

    // Test without phone_number
    $authentication->dbConnectionsChangePassword($email, $connection);
    $requestWithoutPhone = $authentication->getHttpClient()->getLastRequest()->getLastRequest();
    $requestBodyWithoutPhone = json_decode($requestWithoutPhone->getBody()->__toString(), true);

    $this->assertArrayNotHasKey('phone_number', $requestBodyWithoutPhone);
});

test('pushedAuthorizationRequest() returns an instance of Auth0\SDK\API\Authentication\PushedAuthorizationRequest', function () {
    $authentication = $this->sdk->authentication();
    $pushedAuthorizationRequest = $authentication->pushedAuthorizationRequest();

    expect($pushedAuthorizationRequest)->toBeInstanceOf(PushedAuthorizationRequest::class);
});
