<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class OrganizationsTest.
 * Tests the Auth0\SDK\API\Management\Organizations class.
 *
 * @group unit
 * @group management
 * @group organizations
 */
class OrganizationsTest extends TestCase
{
    /**
     * Test that create organization request is formed correctly.
     */
    public function testThatCreateOrganizationRequestIsFormedCorrectly(): void
    {
        $mock = (object) [
            'id' => uniqid(),
            'name' => uniqid(),
            'branding' => [
                'logo_url' => uniqid(),
            ],
            'metadata' => [
                'test' => uniqid()
            ],
            'body' => [
                'additional' => [
                    'testing' => uniqid()
                ]
            ]
        ];

        $api = new MockManagementApi();

        $api->mock()->organizations()->create($mock->id, $mock->name, $mock->branding, $mock->metadata, $mock->body);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();

        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mock->id, $body['name']);

        $this->assertArrayHasKey('display_name', $body);
        $this->assertEquals($mock->name, $body['display_name']);

        $this->assertArrayHasKey('branding', $body);
        $this->assertArrayHasKey('logo_url', $body['branding']);
        $this->assertEquals($mock->branding['logo_url'], $body['branding']['logo_url']);

        $this->assertArrayHasKey('metadata', $body);
        $this->assertArrayHasKey('test', $body['metadata']);
        $this->assertEquals($mock->metadata['test'], $body['metadata']['test']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(array_merge(['name' => $mock->id, 'display_name' => $mock->name, 'branding' => $mock->branding, 'metadata' => $mock->metadata], $mock->body)), $body);
    }

    /**
     * Test that create organization request with empty name throws exception.
     */
    public function testThatCreateOrganizationRequestWithEmptyNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

        $api->mock()->organizations()->create('', '');
    }

    /**
     * Test that create organization request with empty display name throws exception.
     */
    public function testThatCreateOrganizationRequestWithEmptyDisplayNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'displayName'));

        $api->mock()->organizations()->create('test-organization', '');
    }

    /**
     * Test that update organization request is formed correctly.
     */
    public function testThatUpdateOrganizationRequestIsFormedCorrectly(): void
    {
        $mock = (object) [
            'id' => uniqid(),
            'name' => uniqid(),
            'displayName' => uniqid(),
            'branding' => [
                'logo_url' => uniqid(),
            ],
            'metadata' => [
                'test' => uniqid()
            ],
            'body' => [
                'additional' => [
                    'testing' => uniqid()
                ]
            ]
        ];

        $api = new MockManagementApi();

        $api->mock()->organizations()->update($mock->id, $mock->name, $mock->displayName, $mock->branding, $mock->metadata, $mock->body);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations/' . $mock->id, $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();

        $this->assertArrayHasKey('name', $body);
        $this->assertEquals($mock->name, $body['name']);

        $this->assertArrayHasKey('display_name', $body);
        $this->assertEquals($mock->displayName, $body['display_name']);

        $this->assertArrayHasKey('branding', $body);
        $this->assertArrayHasKey('logo_url', $body['branding']);
        $this->assertEquals($mock->branding['logo_url'], $body['branding']['logo_url']);

        $this->assertArrayHasKey('metadata', $body);
        $this->assertArrayHasKey('test', $body['metadata']);
        $this->assertEquals($mock->metadata['test'], $body['metadata']['test']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(array_merge(['name' => $mock->name, 'display_name' => $mock->displayName, 'branding' => $mock->branding, 'metadata' => $mock->metadata], $mock->body)), $body);
    }

    /**
     * Test that update organization request with empty id throws exception.
     */
    public function testThatUpdateOrganizationRequestWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->update('', '', '');
    }

    /**
     * Test that update organization request with empty display name throws exception.
     */
    public function testThatUpdateOrganizationRequestWithEmptyDisplayNameThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'displayName'));

        $api->mock()->organizations()->update('test-organization', '', '');
    }

    /**
     * Test that delete organization request is formed correctly.
     */
    public function testThatDeleteOrganizationRequestIsFormedCorrectly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->delete('test-organization');

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/organizations/test-organization', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);
    }

    /**
     * Test that delete organization request with empty id throws exception.
     */
    public function testThatDeleteOrganizationRequestWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->delete('');
    }

    /**
     * Test that get all request is formed properly.
     */
    public function testThatGetAllRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getAll();

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations', $api->getRequestUrl());
    }

    /**
     * Test that get request is formed properly.
     */
    public function testThatGetRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->get('123');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/123', $api->getRequestUrl());
    }

    /**
     * Test that get with empty id throws exception.
     */
    public function testThatGetWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->get('');
    }

    /**
     * Test that get by name request is formed properly.
     */
    public function testThatGetByNameRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getByName('test-organization');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/name/test-organization', $api->getRequestUrl());
    }

    /**
     * Test that get by name with empty id throws exception.
     */
    public function testThatGetByNameWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

        $api->mock()->organizations()->getByName('');
    }

    /**
     * Test that get enabled connections request is formed properly.
     */
    public function testThatGetEnabledConnectionsRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getEnabledConnections('test-organization');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getRequestUrl());
    }

    /**
     * Test that get enabled connections with empty id throws exception.
     */
    public function testThatGetEnabledConnectionsWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getEnabledConnections('');
    }

    /**
     * Test that get enabled connection request is formed properly.
     */
    public function testThatGetEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getRequestUrl());
    }

    /**
     * Test that get enabled connection with empty id throws exception.
     */
    public function testThatGetEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getEnabledConnection('', '');
    }

    /**
     * Test that get enabled connection with empty connection throws exception.
     */
    public function testThatGetEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

        $api->mock()->organizations()->getEnabledConnection('test-organization', '');
    }

    /**
     * Test that add enabled connection request is formed properly.
     */
    public function testThatAddEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->addEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('connection_id', $body);
        $this->assertEquals('test-connection', $body['connection_id']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['connection_id' => 'test-connection', 'assign_membership_on_login' => true]), $body);
    }

    /**
     * Test that add enabled connection with empty id throws exception.
     */
    public function testThatAddEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->addEnabledConnection('', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that add enabled connection with empty connection throws exception.
     */
    public function testThatAddEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

        $api->mock()->organizations()->addEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that update enabled connection request is formed properly.
     */
    public function testThatUpdateEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->updateEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('assign_membership_on_login', $body);
        $this->assertTrue($body['assign_membership_on_login']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['assign_membership_on_login' => true]), $body);
    }

    /**
     * Test that update enabled connection with empty id throws exception.
     */
    public function testThatUpdateEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->updateEnabledConnection('', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that update enabled connection with empty connection throws exception.
     */
    public function testThatUpdateEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

        $api->mock()->organizations()->updateEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
    }

    /**
     * Test that remove enabled connection request is formed properly.
     */
    public function testThatRemoveEnabledConnectionRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->removeEnabledConnection('test-organization', 'test-connection');

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection', $api->getRequestUrl());
    }

    /**
     * Test hat remove enabled connection with empty id throws exception.
     */
    public function testThatRemoveEnabledConnectionWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->removeEnabledConnection('', '');
    }

    /**
     * Test that remove enabled connection with empty connection throws exception.
     */
    public function testThatRemoveEnabledConnectionWithEmptyConnectionThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

        $api->mock()->organizations()->removeEnabledConnection('test-organization', '');
    }

    /**
     * Test that get members request is formed properly.
     */
    public function testThatGetMembersRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getMembers('test-organization');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getRequestUrl());
    }

    /**
     * Test that get members with empty id throws exception.
     */
    public function testThatGetMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getMembers('');
    }

    /**
     * Test that add members request is formed properly.
     */
    public function testThatAddMembersRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->addMembers('test-organization', ['test-user']);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('members', $body);
        $this->assertContains('test-user', $body['members']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['members' => ['test-user']]), $body);
    }

    /**
     * Test that add members request with empty id throws exception.
     */
    public function testThatAddMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->addMembers('', []);
    }

    /**
     * Test that add members with empty users throws exception.
     */
    public function testThatAddMembersWithEmptyUsersThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'members'));

        $api->mock()->organizations()->addMembers('test-organization', []);
    }

    /**
     * Test that remove members request is formed properly.
     */
    public function testThatRemoveMembersRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->removeMembers('test-organization', ['test-user']);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('members', $body);
        $this->assertContains('test-user', $body['members']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['members' => ['test-user']]), $body);
    }

    /**
     * Test that remove members with empty id throws exception.
     */
    public function testThatRemoveMembersWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->removeMembers('', []);
    }

    /**
     * Test that remove members with empty users throws exception.
     */
    public function testThatRemoveMembersWithEmptyUsersThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'members'));

        $api->mock()->organizations()->removeMembers('test-organization', []);
    }

    /**
     * Test that get member roles request is formed properly.
     */
    public function testThatGetMemberRolesRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getMemberRoles('test-organization', 'test-user');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getRequestUrl());
    }

    /**
     * Test that get member roles with empty id throws exception.
     */
    public function testThatGetMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getMemberRoles('', '');
    }

    /**
     * Test that get member roles with empty user throws exception.
     */
    public function testThatGetMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

        $api->mock()->organizations()->getMemberRoles('test-organization', '');
    }

    /**
     * Test that add member roles request is formed properly.
     */
    public function testThatAddMemberRolesRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->addMemberRoles('test-organization', 'test-user', ['test-role']);

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertContains('test-role', $body['roles']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['roles' => ['test-role']]), $body);
    }

    /**
     * Test that add member roles with empty id throws exception.
     */
    public function testThatAddMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->addMemberRoles('', '', []);
    }

    /**
     * Test that add member roles with empty user throws exception.
     */
    public function testThatAddMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

        $api->mock()->organizations()->addMemberRoles('test-organization', '', []);
    }

    /**
     * Test that add member roles with empty roles throws exception.
     */
    public function testThatAddMemberRolesWithEmptyRolesThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'roles'));

        $api->mock()->organizations()->addMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that remove member roles request is formed properly.
     */
    public function testThatRemoveMemberRolesRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->removeMemberRoles('test-organization', 'test-user', ['test-role']);

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('roles', $body);
        $this->assertContains('test-role', $body['roles']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['roles' => ['test-role']]), $body);
    }

    /**
     * Test that remove member roles with empty id throws exception.
     */
    public function testThatRemoveMemberRolesWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->removeMemberRoles('', '', []);
    }

    /**
     * Test that remove member roles with empty user throws exception.
     */
    public function testThatRemoveMemberRolesWithEmptyUserThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

        $api->mock()->organizations()->removeMemberRoles('test-organization', '', []);
    }

    /**
     * Test that remove member roles with empty roles throws exception.
     */
    public function testThatRemoveMemberRolesWithEmptyRolesThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'roles'));

        $api->mock()->organizations()->removeMemberRoles('test-organization', 'test-rule', []);
    }

    /**
     * Test that get invitations request is formed properly.
     */
    public function testThatGetInvitationsRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getInvitations('test-organization');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getRequestUrl());
    }

    /**
     * Test that get invitations with empty id throws exception.
     */
    public function testThatGetInvitationsWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getInvitations('');
    }

    /**
     * Test that get invitation request is formed properly.
     */
    public function testThatGetInvitationRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->getInvitation('test-organization', 'test-invitation');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getRequestUrl());
    }

    /**
     * Test that get invitation with empty id throws exception.
     */
    public function testThatGetInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->getInvitation('', '');
    }

    /**
     * Test that get invitation with empty invitation throws exception.
     */
    public function testThatGetInvitationWithEmptyInvitationThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitationId'));

        $api->mock()->organizations()->getInvitation('test-organization', '');
    }

    /**
     * Test that create invitation request is formed properly.
     */
    public function testThatCreateInvitationRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->createInvitation(
            'test-organization',
            'test-client',
            ['name' => 'Test Sender'],
            ['email' => 'email@test.com']
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations', $api->getRequestUrl());

        $headers = $api->getRequestHeaders();
        $this->assertEquals('application/json', $headers['Content-Type'][0]);

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('client_id', $body);
        $this->assertEquals('test-client', $body['client_id']);
        $this->assertArrayHasKey('inviter', $body);
        $this->assertArrayHasKey('name', $body['inviter']);
        $this->assertEquals('Test Sender', $body['inviter']['name']);
        $this->assertArrayHasKey('invitee', $body);
        $this->assertArrayHasKey('email', $body['invitee']);
        $this->assertEquals('email@test.com', $body['invitee']['email']);

        $body = $api->getRequestBodyAsString();
        $this->assertEquals(json_encode(['client_id' => 'test-client', 'inviter' => ['name' => 'Test Sender'], 'invitee' => ['email' => 'email@test.com']]), $body);
    }

    /**
     * Test that create invitation with empty id throws exception.
     */
    public function testThatCreateInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->createInvitation('', '', [], []);
    }

    /**
     * Test that create invitation with empty client throws exception.
     */
    public function testThatCreateInvitationWithEmptyClientThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'clientId'));

        $api->mock()->organizations()->createInvitation('test-organization', '', [], []);
    }

    /**
     * Test that create invitation with empty inviter throws exception.
     */
    public function testThatCreateInvitationWithEmptyInviterThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'inviter'));

        $api->mock()->organizations()->createInvitation('test-organization', 'test-client', [], []);
    }

    /**
     * Test that create invitation with empty invitee throws exception.
     */
    public function testThatCreateInvitationWithEmptyInviteeThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitee'));

        $api->mock()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], []);
    }

    /**
     * Test that create invitation with malformed inviter throws exception.
     */
    public function testThatCreateInvitationWithMalformedInviterThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'inviter.name'));

        $api->mock()->organizations()->createInvitation('test-organization', 'test-client', ['test' => 'test'], ['test' => 'test']);
    }

    /**
     * Test that create invitation with malformed invitee throws exception.
     */
    public function testThatCreateInvitationWithMalformedInviteeThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitee.email'));

        $api->mock()->organizations()->createInvitation('test-organization', 'test-client', ['name' => 'Test Sender'], ['test' => 'test']);
    }

    /**
     * Test that delete invitation request is formed properly.
     */
    public function testThatDeleteInvitationRequestIsFormedProperly(): void
    {
        $api = new MockManagementApi();

        $api->mock()->organizations()->deleteInvitation('test-organization', 'test-invitation');

        $this->assertEquals('DELETE', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation', $api->getRequestUrl());
    }

    /**
     * Test that delete invitation with empty id throws exception.
     */
    public function testThatDeleteInvitationWithEmptyIdThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

        $api->mock()->organizations()->deleteInvitation('', '');
    }

    /**
     * Test that delete invitation with empty client throws exception.
     */
    public function testThatDeleteInvitationWithEmptyClientThrowsException(): void
    {
        $api = new MockManagementApi();

        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitationId'));

        $api->mock()->organizations()->deleteInvitation('test-organization', '');
    }
}
