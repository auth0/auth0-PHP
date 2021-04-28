<?php

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Psr7\Response;

/**
 * Class OrganizationsTest.
 * Tests the Auth0\SDK\API\Management\Organizations class.
 *
 * @group unit
 * @group management
 * @group organizations
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
    protected static $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     *
     * @return void
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test that create organization request is formed correctly.
     *
     * @return void
     */
    public function testThatCreateOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->create(
            'test-organization',
            'Test Organization',
            [
                'logo_url' => 'https://test.com/test.png',
            ],
            [
                'meta' => 'data',
            ]
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey('name', $body);
        $this->assertEquals('test-organization', $body['name']);

        $this->assertArrayHasKey('display_name', $body);
        $this->assertEquals('Test Organization', $body['display_name']);

        $this->assertArrayHasKey('branding', $body);
        $this->assertArrayHasKey('logo_url', $body['branding']);
        $this->assertEquals('https://test.com/test.png', $body['branding']['logo_url']);

        $this->assertArrayHasKey('metadata', $body);
        $this->assertArrayHasKey('meta', $body['metadata']);
        $this->assertEquals('data', $body['metadata']['meta']);
    }

    /**
     * Test that create organization request with empty name throws exception.
     *
     * @return void
     */
    public function testThatCreateOrganizationRequestWithEmptyNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid name.');

        $api->call()->organizations()->create('', '');
    }

    /**
     * Test that create organization request with empty display name throws exception.
     *
     * @return void
     */
    public function testThatCreateOrganizationRequestWithEmptyDisplayNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->create('test-organization', '');
    }

    /**
     * Test that update organization request is formed correctly.
     *
     * @return void
     */
    public function testThatUpdateOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->update(
            'test-organization',
            'Test Organization',
            [
                'logo_url' => 'https://test.com/test.png',
            ],
            [
                'meta' => 'data',
            ]
        );

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations/test-organization', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();

        $this->assertArrayHasKey('display_name', $body);
        $this->assertEquals('Test Organization', $body['display_name']);

        $this->assertArrayHasKey('branding', $body);
        $this->assertArrayHasKey('logo_url', $body['branding']);
        $this->assertEquals('https://test.com/test.png', $body['branding']['logo_url']);

        $this->assertArrayHasKey('metadata', $body);
        $this->assertArrayHasKey('meta', $body['metadata']);
        $this->assertEquals('data', $body['metadata']['meta']);
    }

    /**
     * Test that update organization request with empty id throws exception.
     *
     * @return void
     */
    public function testThatUpdateOrganizationRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->update('', '');
    }

    /**
     * Test that update organization request with empty display name throws exception.
     *
     * @return void
     */
    public function testThatUpdateOrganizationRequestWithEmptyDisplayNameThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->update('test-organization', '');
    }

    /**
     * Test that delete organization request is formed correctly.
     *
     * @return void
     */
    public function testThatDeleteOrganizationRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->delete('test-organization');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations/test-organization', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test that delete organization request with empty id throws exception.
     *
     * @return void
     */
    public function testThatDeleteOrganizationRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->update('', '');
    }

    /**
     * Test that get all request is formed properly.
     *
     * @return void
     */
    public function testThatGetAllRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getAll();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations', $api->getHistoryUrl());
    }

    /**
     * Test that get request is formed properly.
     *
     * @return void
     */
    public function testThatGetRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->get('123');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/123', $api->getHistoryUrl());
    }

    /**
     * Test that get with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->get('');
    }

    /**
     * Test that get by name request is formed properly.
     *
     * @return void
     */
    public function testThatGetByNameRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getByName('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/name/test-organization', $api->getHistoryUrl());
    }

    /**
     * Test that get by name with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetByNameWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organizationName.');

        $api->call()->organizations()->getByName('');
    }

    /**
     * Test that get enabled connections request is formed properly.
     *
     * @return void
     */
    public function testThatGetEnabledConnectionsRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getEnabledConnections('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl());
    }

    /**
     * Test that get enabled connections with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetEnabledConnectionsWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getEnabledConnections('');
    }

    /**
     * Test that get enabled connection request is formed properly.
     *
     * @return void
     */
    public function testThatGetEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl());
    }

    /**
     * Test that get enabled connection with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getEnabledConnection('', '');
    }

    /**
     * Test that get enabled connection with empty connection throws exception.
     *
     * @return void
     */
    public function testThatGetEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->getEnabledConnection('test-organization', '');
    }

    /**
     * Test that add enabled connection request is formed properly.
     *
     * @return void
     */
    public function testThatAddEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->addEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals('test-connection', $body['connection_id']);
    }

    /**
     * Test that add enabled connection with empty id throws exception.
     *
     * @return void
     */
    public function testThatAddEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addEnabledConnection('', '');
    }

    /**
     * Test that add enabled connection with empty connection throws exception.
     *
     * @return void
     */
    public function testThatAddEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->addEnabledConnection('test-organization', '');
    }

    /**
     * Test that update enabled connection request is formed properly.
     *
     * @return void
     */
    public function testThatUpdateEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->updateEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('assign_membership_on_login', $body);
        $this->assertTrue($body['assign_membership_on_login']);
    }

    /**
     * Test that update enabled connection with empty id throws exception.
     *
     * @return void
     */
    public function testThatUpdateEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->updateEnabledConnection('', '');
    }

    /**
     * Test that update enabled connection with empty connection throws exception.
     *
     * @return void
     */
    public function testThatUpdateEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->updateEnabledConnection('test-organization', '');
    }

    /**
     * Test that remove enabled connection request is formed properly.
     *
     * @return void
     */
    public function testThatRemoveEnabledConnectionRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->removeEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl());
    }

    /**
     * Test hat remove enabled connection with empty id throws exception.
     *
     * @return void
     */
    public function testThatRemoveEnabledConnectionWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeEnabledConnection('', '');
    }

    /**
     * Test that remove enabled connection with empty connection throws exception.
     *
     * @return void
     */
    public function testThatRemoveEnabledConnectionWithEmptyConnectionThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connection.');

        $api->call()->organizations()->removeEnabledConnection('test-organization', '');
    }

    /**
     * Test that get members request is formed properly.
     *
     * @return void
     */
    public function testThatGetMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getMembers('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl());
    }

    /**
     * Test that get members with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getMembers('');
    }

    /**
     * Test that add members request is formed properly.
     *
     * @return void
     */
    public function testThatAddMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->addMembers('test-organization', ['test-user']);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('members', $body);
        $this->assertContains('test-user', $body['members']);
    }

    /**
     * Test that add members request with empty id throws exception.
     *
     * @return void
     */
    public function testThatAddMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addMembers('', []);
    }

    /**
     * Test that add members with empty users throws exception.
     *
     * @return void
     */
    public function testThatAddMembersWithEmptyUsersThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid users.');

        $api->call()->organizations()->addMembers('test-organization', []);
    }

    /**
     * Test that remove members request is formed properly.
     *
     * @return void
     */
    public function testThatRemoveMembersRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->removeMembers('test-organization', ['test-user']);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('members', $body);
        $this->assertContains('test-user', $body['members']);
    }

    /**
     * Test that remove members with empty id throws exception.
     *
     * @return void
     */
    public function testThatRemoveMembersWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeMembers('', []);
    }

    /**
     * Test that remove members with empty users throws exception.
     *
     * @return void
     */
    public function testThatRemoveMembersWithEmptyUsersThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid users.');

        $api->call()->organizations()->removeMembers('test-organization', []);
    }

    /**
     * Test that get member roles request is formed properly.
     *
     * @return void
     */
    public function testThatGetMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getMemberRoles('test-organization', 'test-user');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl());
    }

    /**
     * Test that get member roles with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getMemberRoles('', '');
    }

    /**
     * Test that get member roles with empty user throws exception.
     *
     * @return void
     */
    public function testThatGetMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->getMemberRoles('test-organization', '');
    }

    /**
     * Test that add member roles request is formed properly.
     *
     * @return void
     */
    public function testThatAddMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->addMemberRoles('test-organization', 'test-user', ['test-role']);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertContains('test-role', $body['roles']);
    }

    /**
     * Test that add member roles with empty id throws exception.
     *
     * @return void
     */
    public function testThatAddMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->addMemberRoles('', '', []);
    }

    /**
     * Test that add member roles with empty user throws exception.
     *
     * @return void
     */
    public function testThatAddMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->addMemberRoles('test-organization', '', []);
    }

    /**
     * Test that add member roles with empty roles throws exception.
     *
     * @return void
     */
    public function testThatAddMemberRolesWithEmptyRolesThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->addMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that remove member roles request is formed properly.
     *
     * @return void
     */
    public function testThatRemoveMemberRolesRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->removeMemberRoles('test-organization', 'test-user', ['test-role']);

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertContains('test-role', $body['roles']);
    }

    /**
     * Test that remove member roles with empty id throws exception.
     *
     * @return void
     */
    public function testThatRemoveMemberRolesWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->removeMemberRoles('', '', []);
    }

    /**
     * Test that remove member roles with empty user throws exception.
     *
     * @return void
     */
    public function testThatRemoveMemberRolesWithEmptyUserThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid user.');

        $api->call()->organizations()->removeMemberRoles('test-organization', '', []);
    }

    /**
     * Test that remove member roles with empty roles throws exception.
     *
     * @return void
     */
    public function testThatRemoveMemberRolesWithEmptyRolesThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->removeMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that get invitations request is formed properly.
     *
     * @return void
     */
    public function testThatGetInvitationsRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getInvitations('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getHistoryUrl());
    }

    /**
     * Test that get invitations with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetInvitationsWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getInvitations('');
    }

    /**
     * Test that get invitation request is formed properly.
     *
     * @return void
     */
    public function testThatGetInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getInvitation('test-organization', 'test-invitation');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl());
    }

    /**
     * Test that get invitation with empty id throws exception.
     *
     * @return void
     */
    public function testThatGetInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->getInvitation('', '');
    }

    /**
     * Test that get invitation with empty invitation throws exception.
     *
     * @return void
     */
    public function testThatGetInvitationWithEmptyInvitationThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitation.');

        $api->call()->organizations()->getInvitation('test-organization', '');
    }

    /**
     * Test that create invitation request is formed properly.
     *
     * @return void
     */
    public function testThatCreateInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->createInvitation(
            'test-organization',
            'test-client',
            ['name' => 'Test Sender'],
            ['email' => 'email@test.com']
        );

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getHistoryUrl());

        $headers = $api->getHistoryHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('client_id', $body);
        $this->assertEquals('test-client', $body['client_id']);
        $this->assertArrayHasKey('inviter', $body);
        $this->assertArrayHasKey('name', $body['inviter']);
        $this->assertEquals('Test Sender', $body['inviter']['name']);
        $this->assertArrayHasKey('invitee', $body);
        $this->assertArrayHasKey('email', $body['invitee']);
        $this->assertEquals('email@test.com', $body['invitee']['email']);
    }

    /**
     * Test that create invitation with empty id throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->createInvitation('', '', [], []);
    }

    /**
     * Test that create invitation with empty client throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithEmptyClientThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid clientId.');

        $api->call()->organizations()->createInvitation('test-organization', '', [], []);
    }

    /**
     * Test that create invitation with empty inviter throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithEmptyInviterThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', [], []);
    }

    /**
     * Test that create invitation with empty invitee throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithEmptyInviteeThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], []);
    }

    /**
     * Test that create invitation with malformed inviter throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithMalformedInviterThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], ['test' => 'test']);
    }

    /**
     * Test that create invitation with malformed invitee throws exception.
     *
     * @return void
     */
    public function testThatCreateInvitationWithMalformedInviteeThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['name' => 'Test Sender'], ['test' => 'test']);
    }

    /**
     * Test that delete invitation request is formed properly.
     *
     * @return void
     */
    public function testThatDeleteInvitationRequestIsFormedProperly()
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->deleteInvitation('test-organization', 'test-invitation');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl());
    }

    /**
     * Test that delete invitation with empty id throws exception.
     *
     * @return void
     */
    public function testThatDeleteInvitationWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid organization.');

        $api->call()->organizations()->deleteInvitation('', '');
    }

    /**
     * Test that delete invitation with empty client throws exception.
     *
     * @return void
     */
    public function testThatDeleteInvitationWithEmptyClientThrowsException()
    {
        $api = new MockManagementApi();

        $this->expectException(EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitation.');

        $api->call()->organizations()->deleteInvitation('test-organization', '');
    }
}
