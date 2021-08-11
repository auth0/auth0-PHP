<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\TokenGenerator;
use Http\Discovery\Psr18ClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('management');

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
        'managementToken' => uniqid()
    ]);

    $this->sdk = new Auth0($this->configuration);
});

test('__construct() fails without a configuration', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_CONFIGURATION_REQUIRED);

    new Management(null);
});

test('getHttpClient() fails without a managementToken, if client id and secret are not configured', function(): void {
    $this->configuration->setManagementToken(null);

    $this->expectException(\Auth0\SDK\Exception\ConfigurationException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_MANAGEMENT_KEY);

    $this->sdk->management()->blacklists();
});

test('blacklists() returns an instance of Auth0\SDK\API\Management\Blacklists', function(): void {
    $class = $this->sdk->management()->blacklists();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Blacklists::class, $class);
});

test('clients() returns an instance of Auth0\SDK\API\Management\Clients', function(): void {
    $class = $this->sdk->management()->clients();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Clients::class, $class);
});

test('clientGrants() returns an instance of Auth0\SDK\API\Management\ClientGrants', function(): void {
    $class = $this->sdk->management()->clientGrants();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\ClientGrants::class, $class);
});

test('connections() returns an instance of Auth0\SDK\API\Management\Connections', function(): void {
    $class = $this->sdk->management()->connections();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Connections::class, $class);
});

test('deviceCredentials() returns an instance of Auth0\SDK\API\Management\DeviceCredentials', function(): void {
    $class = $this->sdk->management()->deviceCredentials();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\DeviceCredentials::class, $class);
});

test('emails() returns an instance of Auth0\SDK\API\Management\Emails', function(): void {
    $class = $this->sdk->management()->emails();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Emails::class, $class);
});

test('emailTemplates() returns an instance of Auth0\SDK\API\Management\EmailTemplates', function(): void {
    $class = $this->sdk->management()->emailTemplates();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\EmailTemplates::class, $class);
});

test('grants() returns an instance of Auth0\SDK\API\Management\Grants', function(): void {
    $class = $this->sdk->management()->grants();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Grants::class, $class);
});

test('guardian() returns an instance of Auth0\SDK\API\Management\Guardian', function(): void {
    $class = $this->sdk->management()->guardian();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Guardian::class, $class);
});

test('jobs() returns an instance of Auth0\SDK\API\Management\Jobs', function(): void {
    $class = $this->sdk->management()->jobs();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Jobs::class, $class);
});

test('logs() returns an instance of Auth0\SDK\API\Management\Logs', function(): void {
    $class = $this->sdk->management()->logs();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Logs::class, $class);
});

test('logStreams() returns an instance of Auth0\SDK\API\Management\LogStreams', function(): void {
    $class = $this->sdk->management()->logStreams();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\LogStreams::class, $class);
});

test('organizations() returns an instance of Auth0\SDK\API\Management\Organizations', function(): void {
    $class = $this->sdk->management()->organizations();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Organizations::class, $class);
});

test('roles() returns an instance of Auth0\SDK\API\Management\Roles', function(): void {
    $class = $this->sdk->management()->roles();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Roles::class, $class);
});

test('rules() returns an instance of Auth0\SDK\API\Management\Rules', function(): void {
    $class = $this->sdk->management()->rules();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Rules::class, $class);
});

test('resourceServers() returns an instance of Auth0\SDK\API\Management\ResourceServers', function(): void {
    $class = $this->sdk->management()->resourceServers();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\ResourceServers::class, $class);
});

test('stats() returns an instance of Auth0\SDK\API\Management\Stats', function(): void {
    $class = $this->sdk->management()->stats();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Stats::class, $class);
});

test('tenants() returns an instance of Auth0\SDK\API\Management\Tenants', function(): void {
    $class = $this->sdk->management()->tenants();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Tenants::class, $class);
});

test('tickets() returns an instance of Auth0\SDK\API\Management\Tickets', function(): void {
    $class = $this->sdk->management()->tickets();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Tickets::class, $class);
});

test('userBlocks() returns an instance of Auth0\SDK\API\Management\UserBlocks', function(): void {
    $class = $this->sdk->management()->userBlocks();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\UserBlocks::class, $class);
});

test('users() returns an instance of Auth0\SDK\API\Management\Users', function(): void {
    $class = $this->sdk->management()->users();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Users::class, $class);
});

test('usersByEmail() returns an instance of Auth0\SDK\API\Management\UsersByEmail', function(): void {
    $class = $this->sdk->management()->usersByEmail();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\UsersByEmail::class, $class);
});

test('Magic method throws an exception when an invalid class is requested', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_UNKNOWN_METHOD, 'example'));

    $class = $this->sdk->management()->example();
});

test('Caching of management tokens works.', function(): void {
    $managementToken = uniqid();

    $cache = new ArrayAdapter();
    $token = $cache->getItem('managementAccessToken');
    $token->set($managementToken);
    $cache->save($token);

    $this->configuration->setManagementToken(null);
    $this->configuration->setManagementTokenCache($cache);

    $class = $this->sdk->management()->blacklists();

    $this->assertInstanceOf(\Auth0\SDK\API\Management\Blacklists::class, $class);
});

test('A client credential exchange occurs if a managementToken is not configured, but a client id and secret are', function(): void {
    $cache = new ArrayAdapter();

    $this->configuration->setClientSecret(uniqid());
    $this->configuration->setManagementToken(null);
    $this->configuration->setManagementTokenCache($cache);

    $authentication = new Authentication($this->configuration);
    $token = (new TokenGenerator())->withHs256();

    $authentication->getHttpClient()->mockResponse(
        HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6"}')
    );

    $this->sdk->management()->getHttpClient($authentication);

    $this->assertEquals('1.2.3', $cache->getItem('managementAccessToken')->get());
});
