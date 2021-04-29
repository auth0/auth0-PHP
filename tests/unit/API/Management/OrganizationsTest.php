<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
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
     */
    protected static string $expectedTelemetry;

    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    /**
     * Test that create organization request is formed correctly.
     */
    public function testThatCreateOrganizationRequestIsFormedCorrectly(): void
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
     */
    public function testThatCreateOrganizationRequestWithEmptyNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid name.');

        $api->call()->organizations()->create('', '');
    }

    /**
     * Test that create organization request with empty display name throws exception.
     */
    public function testThatCreateOrganizationRequestWithEmptyDisplayNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->create('test-organization', '');
    }

    /**
     * Test that update organization request is formed correctly.
     */
    public function testThatUpdateOrganizationRequestIsFormedCorrectly(): void
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
     */
    public function testThatUpdateOrganizationRequestWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->update('', '');
    }

    /**
     * Test that update organization request with empty display name throws exception.
     */
    public function testThatUpdateOrganizationRequestWithEmptyDisplayNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid displayName.');

        $api->call()->organizations()->update('test-organization', '');
    }

    /**
     * Test that delete organization request is formed correctly.
     */
    public function testThatDeleteOrganizationRequestIsFormedCorrectly(): void
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
     */
    public function testThatDeleteOrganizationRequestWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->update('', '');
    }

    /**
     * Test that get all request is formed properly.
     */
    public function testThatGetAllRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getAll();

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations', $api->getHistoryUrl());
    }

    /**
     * Test that get request is formed properly.
     */
    public function testThatGetRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->get('123');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/123', $api->getHistoryUrl());
    }

    /**
     * Test that get with empty id throws exception.
     */
    public function testThatGetWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->get('');
    }

    /**
     * Test that get by name request is formed properly.
     */
    public function testThatGetByNameRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getByName('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/name/test-organization', $api->getHistoryUrl());
    }

    /**
     * Test that get by name with empty id throws exception.
     */
    public function testThatGetByNameWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid name.');

        $api->call()->organizations()->getByName('');
    }

    /**
     * Test that get enabled connections request is formed properly.
     */
    public function testThatGetEnabledConnectionsRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getEnabledConnections('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl());
    }

    /**
     * Test that get enabled connections with empty id throws exception.
     */
    public function testThatGetEnabledConnectionsWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getEnabledConnections('');
    }

    /**
     * Test that get enabled connection request is formed properly.
     */
    public function testThatGetEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl());
    }

    /**
     * Test that get enabled connection with empty id throws exception.
     */
    public function testThatGetEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getEnabledConnection('', '');
    }

    /**
     * Test that get enabled connection with empty connection throws exception.
     */
    public function testThatGetEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connectionId.');

        $api->call()->organizations()->getEnabledConnection('test-organization', '');
    }

    /**
     * Test that add enabled connection request is formed properly.
     */
    public function testThatAddEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->addEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals('test-connection', $body['connection_id']);
    }

    /**
     * Test that add enabled connection with empty id throws exception.
     */
    public function testThatAddEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->addEnabledConnection('', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that add enabled connection with empty connection throws exception.
     */
    public function testThatAddEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connectionId.');

        $api->call()->organizations()->addEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that update enabled connection request is formed properly.
     */
    public function testThatUpdateEnabledConnectionRequestIsFormedProperly(): void
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
     */
    public function testThatUpdateEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->updateEnabledConnection('', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that update enabled connection with empty connection throws exception.
     */
    public function testThatUpdateEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connectionId.');

        $api->call()->organizations()->updateEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that remove enabled connection request is formed properly.
     */
    public function testThatRemoveEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->removeEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getHistoryUrl());
    }

    /**
     * Test hat remove enabled connection with empty id throws exception.
     */
    public function testThatRemoveEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->removeEnabledConnection('', '');
    }

    /**
     * Test that remove enabled connection with empty connection throws exception.
     */
    public function testThatRemoveEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid connectionId.');

        $api->call()->organizations()->removeEnabledConnection('test-organization', '');
    }

    /**
     * Test that get members request is formed properly.
     */
    public function testThatGetMembersRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getMembers('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getHistoryUrl());
    }

    /**
     * Test that get members with empty id throws exception.
     */
    public function testThatGetMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getMembers('');
    }

    /**
     * Test that add members request is formed properly.
     */
    public function testThatAddMembersRequestIsFormedProperly(): void
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
     */
    public function testThatAddMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->addMembers('', []);
    }

    /**
     * Test that add members with empty users throws exception.
     */
    public function testThatAddMembersWithEmptyUsersThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid members.');

        $api->call()->organizations()->addMembers('test-organization', []);
    }

    /**
     * Test that remove members request is formed properly.
     */
    public function testThatRemoveMembersRequestIsFormedProperly(): void
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
     */
    public function testThatRemoveMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->removeMembers('', []);
    }

    /**
     * Test that remove members with empty users throws exception.
     */
    public function testThatRemoveMembersWithEmptyUsersThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid members.');

        $api->call()->organizations()->removeMembers('test-organization', []);
    }

    /**
     * Test that get member roles request is formed properly.
     */
    public function testThatGetMemberRolesRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getMemberRoles('test-organization', 'test-user');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getHistoryUrl());
    }

    /**
     * Test that get member roles with empty id throws exception.
     */
    public function testThatGetMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getMemberRoles('', '');
    }

    /**
     * Test that get member roles with empty user throws exception.
     */
    public function testThatGetMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid userId.');

        $api->call()->organizations()->getMemberRoles('test-organization', '');
    }

    /**
     * Test that add member roles request is formed properly.
     */
    public function testThatAddMemberRolesRequestIsFormedProperly(): void
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
     */
    public function testThatAddMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->addMemberRoles('', '', []);
    }

    /**
     * Test that add member roles with empty user throws exception.
     */
    public function testThatAddMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid userId.');

        $api->call()->organizations()->addMemberRoles('test-organization', '', []);
    }

    /**
     * Test that add member roles with empty roles throws exception.
     */
    public function testThatAddMemberRolesWithEmptyRolesThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->addMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that remove member roles request is formed properly.
     */
    public function testThatRemoveMemberRolesRequestIsFormedProperly(): void
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
     */
    public function testThatRemoveMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->removeMemberRoles('', '', []);
    }

    /**
     * Test that remove member roles with empty user throws exception.
     */
    public function testThatRemoveMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid userId.');

        $api->call()->organizations()->removeMemberRoles('test-organization', '', []);
    }

    /**
     * Test that remove member roles with empty roles throws exception.
     */
    public function testThatRemoveMemberRolesWithEmptyRolesThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid roles.');

        $api->call()->organizations()->removeMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that get invitations request is formed properly.
     */
    public function testThatGetInvitationsRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getInvitations('test-organization');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getHistoryUrl());
    }

    /**
     * Test that get invitations with empty id throws exception.
     */
    public function testThatGetInvitationsWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getInvitations('');
    }

    /**
     * Test that get invitation request is formed properly.
     */
    public function testThatGetInvitationRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->getInvitation('test-organization', 'test-invitation');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl());
    }

    /**
     * Test that get invitation with empty id throws exception.
     */
    public function testThatGetInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->getInvitation('', '');
    }

    /**
     * Test that get invitation with empty invitation throws exception.
     */
    public function testThatGetInvitationWithEmptyInvitationThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitationId.');

        $api->call()->organizations()->getInvitation('test-organization', '');
    }

    /**
     * Test that create invitation request is formed properly.
     */
    public function testThatCreateInvitationRequestIsFormedProperly(): void
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
     */
    public function testThatCreateInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->createInvitation('', '', [], []);
    }

    /**
     * Test that create invitation with empty client throws exception.
     */
    public function testThatCreateInvitationWithEmptyClientThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid clientId.');

        $api->call()->organizations()->createInvitation('test-organization', '', [], []);
    }

    /**
     * Test that create invitation with empty inviter throws exception.
     */
    public function testThatCreateInvitationWithEmptyInviterThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', [], []);
    }

    /**
     * Test that create invitation with empty invitee throws exception.
     */
    public function testThatCreateInvitationWithEmptyInviteeThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], []);
    }

    /**
     * Test that create invitation with malformed inviter throws exception.
     */
    public function testThatCreateInvitationWithMalformedInviterThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid inviter.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], ['test' => 'test']);
    }

    /**
     * Test that create invitation with malformed invitee throws exception.
     */
    public function testThatCreateInvitationWithMalformedInviteeThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitee.');

        $api->call()->organizations()->createInvitation('test-organization', 'test-client', ['name' => 'Test Sender'], ['test' => 'test']);
    }

    /**
     * Test that delete invitation request is formed properly.
     */
    public function testThatDeleteInvitationRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->organizations()->deleteInvitation('test-organization', 'test-invitation');

        $this->assertEquals('DELETE', $api->getHistoryMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getHistoryUrl());
    }

    /**
     * Test that delete invitation with empty id throws exception.
     */
    public function testThatDeleteInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid id.');

        $api->call()->organizations()->deleteInvitation('', '');
    }

    /**
     * Test that delete invitation with empty client throws exception.
     */
    public function testThatDeleteInvitationWithEmptyClientThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\EmptyOrInvalidParameterException::class);
        $this->expectExceptionMessage('Empty or invalid invitation.');

        $api->call()->organizations()->deleteInvitation('test-organization', '');
    }
}
