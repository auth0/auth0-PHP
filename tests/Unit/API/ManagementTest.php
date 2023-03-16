<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management\{Blacklists, Clients, ClientGrants, Connections, DeviceCredentials, Emails, EmailTemplates, Grants, Guardian, Jobs, Logs, LogStreams, Organizations, ResourceServers, Roles, Rules, Stats, Tenants, Tickets, UserBlocks, Users, UsersByEmail};
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Exception\NetworkException;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\MockDomain;
use Auth0\Tests\Utilities\TokenGenerator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('management');

beforeEach(function(): void {
    $this->configuration = new SdkConfiguration([
        'domain' => MockDomain::valid(),
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

test('getHttpClient() fails without a managementToken, if client id and secret are not configured', function(): void {
    $this->configuration->setManagementToken(null);
    $this->sdk->management()->blacklists();
})->throws(ConfigurationException::class, ConfigurationException::MSG_REQUIRES_MANAGEMENT_KEY);

test('getHttpClient() fails if tenant is not configured with required scope(s)', function(): void {
    $this->configuration->setClientSecret(uniqid());
    $this->configuration->setManagementToken(null);

    $authentication = new Authentication($this->configuration);
    $authentication->getHttpClient()->mockResponse(
        HttpResponseGenerator::create('{"error":"access_denied","error_description":"Client is not authorized to access"}', 403),
    );

    $this->sdk->management()->getHttpClient($authentication);
})->throws(NetworkException::class, sprintf(NetworkException::MSG_NETWORK_REQUEST_REJECTED, ''));

test('blacklists() returns an instance of Blacklists', function(): void {
    $class = $this->sdk->management()->blacklists();

    expect($class)->toBeInstanceOf(Blacklists::class);
});

test('clients() returns an instance of Clients', function(): void {
    $class = $this->sdk->management()->clients();

    expect($class)->toBeInstanceOf(Clients::class);
});

test('clientGrants() returns an instance of ClientGrants', function(): void {
    $class = $this->sdk->management()->clientGrants();

    expect($class)->toBeInstanceOf(ClientGrants::class);
});

test('connections() returns an instance of Connections', function(): void {
    $class = $this->sdk->management()->connections();

    expect($class)->toBeInstanceOf(Connections::class);
});

test('deviceCredentials() returns an instance of DeviceCredentials', function(): void {
    $class = $this->sdk->management()->deviceCredentials();

    expect($class)->toBeInstanceOf(DeviceCredentials::class);
});

test('emails() returns an instance of Emails', function(): void {
    $class = $this->sdk->management()->emails();

    expect($class)->toBeInstanceOf(Emails::class);
});

test('emailTemplates() returns an instance of EmailTemplates', function(): void {
    $class = $this->sdk->management()->emailTemplates();

    expect($class)->toBeInstanceOf(EmailTemplates::class);
});

test('grants() returns an instance of Grants', function(): void {
    $class = $this->sdk->management()->grants();

    expect($class)->toBeInstanceOf(Grants::class);
});

test('guardian() returns an instance of Guardian', function(): void {
    $class = $this->sdk->management()->guardian();

    expect($class)->toBeInstanceOf(Guardian::class);
});

test('jobs() returns an instance of Jobs', function(): void {
    $class = $this->sdk->management()->jobs();

    expect($class)->toBeInstanceOf(Jobs::class);
});

test('logs() returns an instance of Logs', function(): void {
    $class = $this->sdk->management()->logs();

    expect($class)->toBeInstanceOf(Logs::class);
});

test('logStreams() returns an instance of LogStreams', function(): void {
    $class = $this->sdk->management()->logStreams();

    expect($class)->toBeInstanceOf(LogStreams::class);
});

test('organizations() returns an instance of Organizations', function(): void {
    $class = $this->sdk->management()->organizations();

    expect($class)->toBeInstanceOf(Organizations::class);
});

test('roles() returns an instance of Roles', function(): void {
    $class = $this->sdk->management()->roles();

    expect($class)->toBeInstanceOf(Roles::class);
});

test('rules() returns an instance of Rules', function(): void {
    $class = $this->sdk->management()->rules();

    expect($class)->toBeInstanceOf(Rules::class);
});

test('resourceServers() returns an instance of ResourceServers', function(): void {
    $class = $this->sdk->management()->resourceServers();

    expect($class)->toBeInstanceOf(ResourceServers::class);
});

test('stats() returns an instance of Stats', function(): void {
    $class = $this->sdk->management()->stats();

    expect($class)->toBeInstanceOf(Stats::class);
});

test('tenants() returns an instance of Tenants', function(): void {
    $class = $this->sdk->management()->tenants();

    expect($class)->toBeInstanceOf(Tenants::class);
});

test('tickets() returns an instance of Tickets', function(): void {
    $class = $this->sdk->management()->tickets();

    expect($class)->toBeInstanceOf(Tickets::class);
});

test('userBlocks() returns an instance of UserBlocks', function(): void {
    $class = $this->sdk->management()->userBlocks();

    expect($class)->toBeInstanceOf(UserBlocks::class);
});

test('users() returns an instance of Users', function(): void {
    $class = $this->sdk->management()->users();

    expect($class)->toBeInstanceOf(Users::class);
});

test('usersByEmail() returns an instance of UsersByEmail', function(): void {
    $class = $this->sdk->management()->usersByEmail();

    expect($class)->toBeInstanceOf(UsersByEmail::class);
});

test('getLastRequest() returns an HttpRequest or null', function(): void {
    expect($this->sdk->management()->getLastRequest())->toBeNull();

    try {
        $this->sdk->management()->users()->getAll();
    } catch (Exception) {
    }

    expect($this->sdk->management()->getHttpClient()->getLastRequest())->toBeInstanceOf(HttpRequest::class);
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

    expect($class)->toBeInstanceOf(Blacklists::class);
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
