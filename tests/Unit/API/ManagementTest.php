<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\TokenGenerator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('management');

beforeEach(function(): void {
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
    new Management(null);
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_CONFIGURATION_REQUIRED);

test('getHttpClient() fails without a managementToken, if client id and secret are not configured', function(): void {
    $this->configuration->setManagementToken(null);
    $this->sdk->management()->blacklists();
})->throws(\Auth0\SDK\Exception\ConfigurationException::class, \Auth0\SDK\Exception\ConfigurationException::MSG_REQUIRES_MANAGEMENT_KEY);

test('blacklists() returns an instance of Auth0\SDK\API\Management\Blacklists', function(): void {
    $class = $this->sdk->management()->blacklists();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Blacklists::class);
});

test('clients() returns an instance of Auth0\SDK\API\Management\Clients', function(): void {
    $class = $this->sdk->management()->clients();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Clients::class);
});

test('clientGrants() returns an instance of Auth0\SDK\API\Management\ClientGrants', function(): void {
    $class = $this->sdk->management()->clientGrants();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\ClientGrants::class);
});

test('connections() returns an instance of Auth0\SDK\API\Management\Connections', function(): void {
    $class = $this->sdk->management()->connections();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Connections::class);
});

test('deviceCredentials() returns an instance of Auth0\SDK\API\Management\DeviceCredentials', function(): void {
    $class = $this->sdk->management()->deviceCredentials();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\DeviceCredentials::class);
});

test('emails() returns an instance of Auth0\SDK\API\Management\Emails', function(): void {
    $class = $this->sdk->management()->emails();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Emails::class);
});

test('emailTemplates() returns an instance of Auth0\SDK\API\Management\EmailTemplates', function(): void {
    $class = $this->sdk->management()->emailTemplates();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\EmailTemplates::class);
});

test('grants() returns an instance of Auth0\SDK\API\Management\Grants', function(): void {
    $class = $this->sdk->management()->grants();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Grants::class);
});

test('guardian() returns an instance of Auth0\SDK\API\Management\Guardian', function(): void {
    $class = $this->sdk->management()->guardian();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Guardian::class);
});

test('jobs() returns an instance of Auth0\SDK\API\Management\Jobs', function(): void {
    $class = $this->sdk->management()->jobs();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Jobs::class);
});

test('logs() returns an instance of Auth0\SDK\API\Management\Logs', function(): void {
    $class = $this->sdk->management()->logs();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Logs::class);
});

test('logStreams() returns an instance of Auth0\SDK\API\Management\LogStreams', function(): void {
    $class = $this->sdk->management()->logStreams();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\LogStreams::class);
});

test('organizations() returns an instance of Auth0\SDK\API\Management\Organizations', function(): void {
    $class = $this->sdk->management()->organizations();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Organizations::class);
});

test('roles() returns an instance of Auth0\SDK\API\Management\Roles', function(): void {
    $class = $this->sdk->management()->roles();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Roles::class);
});

test('rules() returns an instance of Auth0\SDK\API\Management\Rules', function(): void {
    $class = $this->sdk->management()->rules();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Rules::class);
});

test('resourceServers() returns an instance of Auth0\SDK\API\Management\ResourceServers', function(): void {
    $class = $this->sdk->management()->resourceServers();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\ResourceServers::class);
});

test('stats() returns an instance of Auth0\SDK\API\Management\Stats', function(): void {
    $class = $this->sdk->management()->stats();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Stats::class);
});

test('tenants() returns an instance of Auth0\SDK\API\Management\Tenants', function(): void {
    $class = $this->sdk->management()->tenants();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Tenants::class);
});

test('tickets() returns an instance of Auth0\SDK\API\Management\Tickets', function(): void {
    $class = $this->sdk->management()->tickets();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Tickets::class);
});

test('userBlocks() returns an instance of Auth0\SDK\API\Management\UserBlocks', function(): void {
    $class = $this->sdk->management()->userBlocks();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\UserBlocks::class);
});

test('users() returns an instance of Auth0\SDK\API\Management\Users', function(): void {
    $class = $this->sdk->management()->users();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Users::class);
});

test('usersByEmail() returns an instance of Auth0\SDK\API\Management\UsersByEmail', function(): void {
    $class = $this->sdk->management()->usersByEmail();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\UsersByEmail::class);
});

test('getLastRequest() returns an HttpRequest or null', function(): void {
    expect($this->sdk->management()->getLastRequest())->toBeNull();

    $this->sdk->management()->users()->getAll();

    expect($this->sdk->management()->getLastRequest())->toBeInstanceOf(HttpRequest::class);
});

test('Magic method throws an exception when an invalid class is requested', function(): void {
    $class = $this->sdk->management()->example();
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_UNKNOWN_METHOD, 'example'));

test('Caching of management tokens works.', function(): void {
    $managementToken = uniqid();

    $cache = new ArrayAdapter();
    $token = $cache->getItem('managementAccessToken');
    $token->set($managementToken);
    $cache->save($token);

    $this->configuration->setManagementToken(null);
    $this->configuration->setManagementTokenCache($cache);

    $class = $this->sdk->management()->blacklists();

    expect($class)->toBeInstanceOf(\Auth0\SDK\API\Management\Blacklists::class);
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

    expect($cache->getItem('managementAccessToken')->get())->toEqual('1.2.3');
});
