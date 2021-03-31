<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use GuzzleHttp\Psr7\Response;
use Auth0\Tests\API\ApiTests;

/**
* Class OrganizationsTest.
* Tests the Auth0\SDK\API\Management\Organizations class.
*
* @group unit
* @group management
* @group organizations
*
* @package Auth0\Tests\integration\API\Management
*/
class OrganizationsTest extends ApiTests
{
    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $expectedTelemetry;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    public function testThatCreateOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->create(
          'test-organization',
          'Test Organization',
          [
            'logo_url' => 'https://test.com/test.png'
          ],
          [
            'meta' => 'data'
          ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/organizations', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( 'test-organization', $body['name'] );

        $this->assertArrayHasKey( 'display_name', $body );
        $this->assertEquals( 'Test Organization', $body['display_name'] );

        $this->assertArrayHasKey( 'branding', $body );
        $this->assertArrayHasKey( 'logo_url', $body['branding']);
        $this->assertEquals( 'https://test.com/test.png', $body['branding']['logo_url'] );

        $this->assertArrayHasKey( 'metadata', $body );
        $this->assertArrayHasKey( 'meta', $body['metadata']);
        $this->assertEquals( 'data', $body['metadata']['meta'] );
    }

    public function testThatCreateOrganizationRequestWithEmptyNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid name.');

        $api->call()->organizations()->create( '', '' );
    }

    public function testThatCreateOrganizationRequestWithEmptyDisplayNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->create( 'test-organization', '' );
    }

    public function testThatUpdateOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->update(
          'test-organization',
          'Test Organization',
          [
            'logo_url' => 'https://test.com/test.png'
          ],
          [
            'meta' => 'data'
          ]
        );

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/organizations/test-organization', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey( 'display_name', $body );
        $this->assertEquals( 'Test Organization', $body['display_name'] );

        $this->assertArrayHasKey( 'branding', $body );
        $this->assertArrayHasKey( 'logo_url', $body['branding']);
        $this->assertEquals( 'https://test.com/test.png', $body['branding']['logo_url'] );

        $this->assertArrayHasKey( 'metadata', $body );
        $this->assertArrayHasKey( 'meta', $body['metadata']);
        $this->assertEquals( 'data', $body['metadata']['meta'] );
    }

    public function testThatUpdateOrganizationRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->update('', '');
    }

    public function testThatUpdateOrganizationRequestWithEmptyDisplayNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->update( 'test-organization', '' );
    }

    public function testThatDeleteOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->delete('test-organization');

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/organizations/test-organization', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatDeleteOrganizationRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->update('', '');
    }

    public function testThatGetAllRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getAll();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->get('123');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/123', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->get( '' );
    }

    public function testThatGetByNameRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getByName('test-organization');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/name/test-organization', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetByNameWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organizationName.');

        $api->call()->organizations()->getByName( '' );
    }

    public function testThatGetEnabledConnectionsRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getEnabledConnections('test-organization');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetEnabledConnectionsWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getEnabledConnections( '' );
    }

    public function testThatGetEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getEnabledConnection( '', '' );
    }

    public function testThatGetEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->getEnabledConnection( 'test-organization', '' );
    }

    public function testThatAddEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->addEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'connection_id', $body );
        $this->assertEquals( 'test-connection', $body['connection_id'] );
    }

    public function testThatAddEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addEnabledConnection( '', '' );
    }

    public function testThatAddEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->addEnabledConnection( 'test-organization', '' );
    }

    public function testThatUpdateEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->updateEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'assign_membership_on_login', $body );
        $this->assertTrue( $body['assign_membership_on_login'] );
    }

    public function testThatUpdateEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->updateEnabledConnection( '', '' );
    }

    public function testThatUpdateEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->updateEnabledConnection( 'test-organization', '' );
    }

    public function testThatRemoveEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->removeEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatRemoveEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeEnabledConnection( '', '' );
    }

    public function testThatRemoveEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->removeEnabledConnection( 'test-organization', '' );
    }

    public function testThatGetMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getMembers('test-organization');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getMembers( '' );
    }

    public function testThatAddMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->addMembers('test-organization', [ 'test-user' ]);

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'members', $body );
        $this->assertContains('test-user', $body['members']);
    }

    public function testThatAddMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addMembers( '', [] );
    }

    public function testThatAddMembersWithEmptyUsersThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid users.');

        $api->call()->organizations()->addMembers( 'test-organization', [] );
    }

    public function testThatRemoveMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->removeMembers('test-organization', [ 'test-user']);

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'members', $body );
        $this->assertContains('test-user', $body['members']);
    }

    public function testThatRemoveMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeMembers( '', [] );
    }

    public function testThatRemoveMembersWithEmptyUsersThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid users.');

        $api->call()->organizations()->removeMembers( 'test-organization', [] );
    }

    public function testThatGetMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getMemberRoles('test-organization', 'test-user');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getMemberRoles( '', '' );
    }

    public function testThatGetMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->getMemberRoles( 'test-organization', '' );
    }

    public function testThatAddMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->addMemberRoles('test-organization', 'test-user', [ 'test-role' ]);

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'roles', $body );
        $this->assertContains('test-role', $body['roles']);
    }

    public function testThatAddMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addMemberRoles( '', '', [] );
    }

    public function testThatAddMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->addMemberRoles( 'test-organization', '', [] );
    }

    public function testThatAddMemberRolesWithEmptyRolesThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->addMemberRoles( 'test-organization', 'test-rule', [] );
    }

    public function testThatRemoveMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->removeMemberRoles('test-organization', 'test-user', [ 'test-role' ]);

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'roles', $body );
        $this->assertContains('test-role', $body['roles']);
    }

    public function testThatRemoveMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeMemberRoles( '', '', [] );
    }

    public function testThatRemoveMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->removeMemberRoles( 'test-organization', '', [] );
    }

    public function testThatRemoveMemberRolesWithEmptyRolesThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->removeMemberRoles( 'test-organization', 'test-rule', [] );
    }

    public function testThatGetInvitationsRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getInvitations('test-organization');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetInvitationsWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getInvitations( '' );
    }

    public function testThatGetInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->getInvitation('test-organization', 'test-invitation');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getInvitation( '', '' );
    }

    public function testThatGetInvitationWithEmptyInvitationThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitation.');

        $api->call()->organizations()->getInvitation( 'test-organization', '' );
    }

    public function testThatCreateInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->createInvitation(
          'test-organization',
          'test-client',
          [ 'name' => 'Test Sender' ],
          [ 'email' => 'email@test.com' ]
        );

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'client_id', $body );
        $this->assertEquals('test-client', $body['client_id']);
        $this->assertArrayHasKey( 'inviter', $body );
        $this->assertArrayHasKey('name', $body['inviter']);
        $this->assertEquals('Test Sender', $body['inviter']['name']);
        $this->assertArrayHasKey( 'invitee', $body );
        $this->assertArrayHasKey('email', $body['invitee']);
        $this->assertEquals('email@test.com', $body['invitee']['email']);
    }

    public function testThatCreateInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->createInvitation( '', '', [], [] );
    }

    public function testThatCreateInvitationWithEmptyClientThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid clientId.');

        $api->call()->organizations()->createInvitation( 'test-organization', '', [], [] );
    }

    public function testThatCreateInvitationWithEmptyInviterThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation( 'test-organization', 'test-client', [], [] );
    }

    public function testThatCreateInvitationWithEmptyInviteeThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation( 'test-organization', 'test-client', [ 'test' => 'test' ], [] );
    }

    public function testThatCreateInvitationWithMalformedInviterThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation( 'test-organization', 'test-client', [ 'test' => 'test' ], [ 'test' => 'test' ] );
    }

    public function testThatCreateInvitationWithMalformedInviteeThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation( 'test-organization', 'test-client', [ 'name' => 'Test Sender' ], [ 'test' => 'test' ] );
    }

    public function testThatDeleteInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->organizations()->deleteInvitation('test-organization', 'test-invitation');

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatDeleteInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->deleteInvitation( '', '', );
    }

    public function testThatDeleteInvitationWithEmptyClientThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitation.');

        $api->call()->organizations()->deleteInvitation( 'test-organization', '' );
    }
}
