<?php

namespace Auth0\Tests\integration\API\Management;

use Auth0\SDK\API\Management;
use Auth0\SDK\API\Management\Organizations;
use Auth0\Tests\API\ApiTests;

/**
* Class OrganizationsIntegrationTest.
* Tests the Auth0\SDK\API\Management\Organizations class.
*
* @group integration
* @group management
* @group organizations
*
* @package Auth0\Tests\integration\API\Management
*/
class OrganizationsIntegrationTest extends ApiTests
{

  /**
   * Management API client.
   * @var Management
   */
  private $management;

  /**
   * Organizations API client.
   * @var Organizations
   */
  private $api;

  /**
   * @var array
   */
  private $organization;

  /**
   * @var array
   */
  private $connection;

  /**
   * @var array
   */
  private $resources;

  /**
   * @var array
   */
  private $user;

  /**
   * @var array
   */
  private $role;

  /**
  * Sets up API client for entire testing class.
  *
  * @return void
  *
  * @throws \Auth0\SDK\Exception\ApiException
  */
  public function setUp(): void
  {
    $env = self::getEnv();

    $this->resources = [
      'name'         => uniqid('php-sdk-test-organization-'),
      'display_name' => 'PHP SDK Integration Test (DELETE)',
      'branding'     => [
        'logo_uri' => 'https://cdn.auth0.com/website/bob/press/logo-light.png',
        'colors'   => [
          'primary'         => '#eb5424',
          'page_background' => '#222228'
        ]
      ]
    ];

    // Initialize Management Client and Organization class
    $this->management = new Management($env['API_TOKEN'], $env['DOMAIN'], ['timeout' => 30]);
    $this->api = $this->management->organizations();

    // Create a new organization for our tests
    $this->organization = $this->api->create($this->resources['name'], $this->resources['display_name']);

    // Create a new connection for our tests
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->connection = $this->management->connections()->create([
      'name'            => uniqid('php-sdk-test-connection-'),
      'strategy'        => 'auth0',
      'enabled_clients' => [ $env['APP_CLIENT_ID'] ]
    ]);

    // Enable new connection with the organization for our tests
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->api->addEnabledConnection($this->organization['id'], $this->connection['id']);

    // Create a new user for our tests
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->user = $this->management->users()->create([
      'email'          => uniqid('php-sdk-test-user-') . '@test.com',
      'connection'     => $this->connection['name'],
      'email_verified' => true,
      'password'       => password_hash(uniqid('php-sdk-test-password-'), PASSWORD_DEFAULT)
    ]);

    // Add the new user to the organization as a member for our tests
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->api->addMembers($this->organization['id'], [ $this->user['user_id'] ]);

    // Add a role to the new member of the organization for our tests
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->role = $this->management->roles()->create(uniqid('php-sdk-test-role-'));
  }

  public function tearDown(): void
  {
    // Cleanup our test role, if it's creation was successful
    if ($this->role) {
      $this->management->roles()->delete($this->role['id']);
    }

    // Cleanup our test user, if it's creation was successful
    if ($this->user) {
      $this->management->users()->delete($this->user['user_id']);
    }

    // Cleanup our test connection, if it's creation was successful
    if ($this->connection) {
      $this->management->connections()->delete($this->connection['id']);
    }

    // Cleanup our test organization, if it's creation was successful
    if ($this->organization) {
      $this->api->delete($this->organization['id']);
    }
  }

  public function testCreate()
  {
    $this->assertArrayHasKey('id', $this->organization);

    $this->assertArrayHasKey('name', $this->organization);
    $this->assertEquals($this->organization['name'], $this->resources['name']);

    $this->assertArrayHasKey('display_name', $this->organization);
    $this->assertEquals($this->organization['display_name'], $this->resources['display_name']);
  }

  public function testUpdate()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->resources['display_name'] .= ' (UPDATED)';
    $this->api->update($this->organization['id'], $this->resources['display_name']);

    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->organization = $this->api->get($this->organization['id']);

    $this->assertArrayHasKey('name', $this->organization);
    $this->assertEquals($this->organization['name'], $this->resources['name']);
  }

  public function testGetAll()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getAll();

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
  }

  public function testGetAllSupportsPagination()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getAll([
      'page' => 1
    ]);

    $this->assertIsArray($response);
  }

  public function testGet()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->get($this->organization['id']);

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
    $this->assertArrayHasKey('id', $this->organization);
  }

  public function testGetByName()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getByName($this->organization['name']);

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
    $this->assertArrayHasKey('id', $this->organization);
  }

  public function testGetEnabledConnections()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getEnabledConnections($this->organization['id']);

    $this->assertIsArray($response);
  }

  public function testEnabledConnections()
  {
    // Confirm 'assign_membership_on_login' is currently false on the organization connection.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getEnabledConnection($this->organization['id'], $this->connection['id']);

    $this->assertFalse($response['assign_membership_on_login']);

    // Change the 'assign_membership_on_login' property on the organization connection.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->api->updateEnabledConnection($this->organization['id'], $this->connection['id'], [ 'assign_membership_on_login' => true ]);

    // Confirm the change was recorded.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getEnabledConnection($this->organization['id'], $this->connection['id']);

    $this->assertIsArray($response);
    $this->assertArrayHasKey('connection_id', $response);
    $this->assertEquals($this->connection['id'], $response['connection_id']);
    $this->assertTrue($response['assign_membership_on_login']);
  }

  public function testRetrieveMembers()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getMembers($this->organization['id']);

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
  }

  public function testRetrieveMembersPaginated()
  {
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getMembers($this->organization['id'], [
      'page' => 1
    ]);

    $this->assertIsArray($response);
  }

  public function testMemberRoles()
  {
    // Confirm that the organization member has no roles.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getMemberRoles($this->organization['id'], $this->user['user_id']);

    $this->assertIsArray($response);
    $this->assertEmpty($response);

    // Add our role to the organization member.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->api->addMemberRoles($this->organization['id'], $this->user['user_id'], [ $this->role['id'] ]);

    // Confirm that the organization member now has the role.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getMemberRoles($this->organization['id'], $this->user['user_id']);

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
    $this->assertArrayHasKey('id', $response[0]);
    $this->assertContainsEquals($this->role['id'], $response[0]);

    // Remove the role from the organization member.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->removeMemberRoles($this->organization['id'], $this->user['user_id'], [ $this->role['id'] ]);

    // Confirm that the organization member once again has no roles.
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getMemberRoles($this->organization['id'], $this->user['user_id']);

    $this->assertIsArray($response);
    $this->assertEmpty($response);
  }

  public function testInvitations()
  {
    $env = self::getEnv();

    // Confirm there are no invitations
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getInvitations($this->organization['id']);

    $this->assertIsArray($response);
    $this->assertEmpty($response);

    // Create an invitation
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->createInvitation(
      $this->organization['id'],
      $env['APP_CLIENT_ID'],
      [
        'name' => 'Evan Sims'
      ],
      [
        'email' => uniqid('php-sdk-test-user-') . '@test.com'
      ]
    );

    $this->assertIsArray($response);
    $this->assertArrayHasKey('organization_id', $response);
    $this->assertEquals($this->organization['id'], $response['organization_id']);
    $this->assertArrayHasKey('client_id', $response);
    $this->assertEquals($env['APP_CLIENT_ID'], $response['client_id']);
    $this->assertArrayHasKey('invitation_url', $response);
    $this->assertArrayHasKey('ticket_id', $response);

    // Confirm pagination works
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getInvitations($this->organization['id'], [ 'page' => 1 ]);

    $this->assertIsArray($response);
    $this->assertEmpty($response);

    // Confirm there is one invitation
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getInvitations($this->organization['id']);

    $this->assertIsArray($response);
    $this->assertNotEmpty($response);
    $this->assertCount(1, $response);
    $this->assertIsArray($response[0]);
    $this->assertArrayHasKey('organization_id', $response[0]);
    $this->assertEquals($this->organization['id'], $response[0]['organization_id']);
    $this->assertArrayHasKey('client_id', $response[0]);
    $this->assertEquals($env['APP_CLIENT_ID'], $response[0]['client_id']);
    $this->assertArrayHasKey('invitation_url', $response[0]);
    $this->assertArrayHasKey('ticket_id', $response[0]);

    // Confirm invitation querying works
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getInvitation($this->organization['id'], $response[0]['id']);

    $this->assertIsArray($response);
    $this->assertArrayHasKey('organization_id', $response);
    $this->assertEquals($this->organization['id'], $response['organization_id']);
    $this->assertArrayHasKey('client_id', $response);
    $this->assertEquals($env['APP_CLIENT_ID'], $response['client_id']);
    $this->assertArrayHasKey('invitation_url', $response);
    $this->assertArrayHasKey('ticket_id', $response);

    // Confirm invitation deletion works
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $this->api->deleteInvitation($this->organization['id'], $response['id']);

    // Confirm no invitations remain
    usleep(AUTH0_PHP_TEST_INTEGRATION_SLEEP);
    $response = $this->api->getInvitations($this->organization['id']);

    $this->assertIsArray($response);
    $this->assertEmpty($response);
  }
}
