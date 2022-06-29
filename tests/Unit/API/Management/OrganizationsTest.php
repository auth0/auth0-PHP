<?php

declare(strict_types=1);

uses()->group('management', 'management.organizations');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->organizations();
});

test('create() issues an appropriate request', function(): void {
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

    $this->endpoint->create($mock->id, $mock->name, $mock->branding, $mock->metadata, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/organizations');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->id);

    $this->assertArrayHasKey('display_name', $body);
    expect($body['display_name'])->toEqual($mock->name);

    $this->assertArrayHasKey('branding', $body);
    $this->assertArrayHasKey('logo_url', $body['branding']);
    expect($body['branding']['logo_url'])->toEqual($mock->branding['logo_url']);

    $this->assertArrayHasKey('metadata', $body);
    $this->assertArrayHasKey('test', $body['metadata']);
    expect($body['metadata']['test'])->toEqual($mock->metadata['test']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mock->id, 'display_name' => $mock->name, 'branding' => $mock->branding, 'metadata' => $mock->metadata], $mock->body)));
});

test('create() throws an exception when an invalid `name` argument is used', function(): void {
    $this->endpoint->create('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

test('create() throws an exception when an invalid `displayName` argument is used', function(): void {
    $this->endpoint->create('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'displayName'));

test('update() issues an appropriate request', function(): void {
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

    $this->endpoint->update($mock->id, $mock->name, $mock->displayName, $mock->branding, $mock->metadata, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/organizations/' . $mock->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mock->name);

    $this->assertArrayHasKey('display_name', $body);
    expect($body['display_name'])->toEqual($mock->displayName);

    $this->assertArrayHasKey('branding', $body);
    $this->assertArrayHasKey('logo_url', $body['branding']);
    expect($body['branding']['logo_url'])->toEqual($mock->branding['logo_url']);

    $this->assertArrayHasKey('metadata', $body);
    $this->assertArrayHasKey('test', $body['metadata']);
    expect($body['metadata']['test'])->toEqual($mock->metadata['test']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mock->name, 'display_name' => $mock->displayName, 'branding' => $mock->branding, 'metadata' => $mock->metadata], $mock->body)));
});

test('update() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->update('', '', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('update() throws an exception when an invalid `displayName` is used', function(): void {
    $this->endpoint->update('test-organization', '', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'displayName'));

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('test-organization');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/organizations/test-organization');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('delete() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->delete('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations');
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('123');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/123');
});

test('get() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->get('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getByName() issues an appropriate request', function(): void {
    $this->endpoint->getByName('test-organization');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/name/test-organization');
});

test('getByName() throws an exception when an invalid `name` is used', function(): void {
    $this->endpoint->getByName('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

test('getEnabledConnections() issues an appropriate request', function(): void {
    $this->endpoint->getEnabledConnections('test-organization');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections');
});

test('getEnabledConnections() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getEnabledConnections('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getEnabledConnection() issues an appropriate request', function(): void {
    $this->endpoint->getEnabledConnection('test-organization', 'test-connection');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection');
});

test('getEnabledConnection() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getEnabledConnection('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getEnabledConnection() throws an exception when an invalid `connectionId` is used', function(): void {
    $this->endpoint->getEnabledConnection('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

test('addEnabledConnection() issues an appropriate request', function(): void {
    $this->endpoint->addEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('connection_id', $body);
    expect($body['connection_id'])->toEqual('test-connection');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['connection_id' => 'test-connection', 'assign_membership_on_login' => true]));
});

test('addEnabledConnection() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->addEnabledConnection('', '', ['assign_membership_on_login' => true]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('addEnabledConnection() throws an exception when an invalid `connectionId` is used', function(): void {
    $this->endpoint->addEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

test('updateEnabledConnection() issues an appropriate request', function(): void {
    $this->endpoint->updateEnabledConnection('test-organization', 'test-connection', ['assign_membership_on_login' => true]);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('assign_membership_on_login', $body);
    expect($body['assign_membership_on_login'])->toBeTrue();

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['assign_membership_on_login' => true]));
});

test('updateEnabledConnection() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->updateEnabledConnection('', '', ['assign_membership_on_login' => true]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('updateEnabledConnection() throws an exception when an invalid `connectionId` is used', function(): void {
    $this->endpoint->updateEnabledConnection('test-organization', '', ['assign_membership_on_login' => true]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

test('removeEnabledConnection() issues an appropriate request', function(): void {
    $this->endpoint->removeEnabledConnection('test-organization', 'test-connection');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/enabled_connections/test-connection');
});

test('removeEnabledConnection() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->removeEnabledConnection('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('removeEnabledConnection() throws an exception when an invalid `connectionId` is used', function(): void {
    $this->endpoint->removeEnabledConnection('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'connectionId'));

test('getMembers() issues an appropriate request', function(): void {
    $this->endpoint->getMembers('test-organization');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members');
});

test('getMembers() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getMembers('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('addMembers() issues an appropriate request', function(): void {
    $this->endpoint->addMembers('test-organization', ['test-user']);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('members', $body);
    expect($body['members'])->toContain('test-user');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['members' => ['test-user']]));
});

test('addMembers() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->addMembers('', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('addMembers() throws an exception when an invalid `members` is used', function(): void {
    $this->endpoint->addMembers('test-organization', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'members'));

test('removeMembers() issues an appropriate request', function(): void {
    $this->endpoint->removeMembers('test-organization', ['test-user']);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('members', $body);
    expect($body['members'])->toContain('test-user');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['members' => ['test-user']]));
});

test('removeMembers() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->removeMembers('', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('removeMembers() throws an exception when an invalid `members` is used', function(): void {
    $this->endpoint->removeMembers('test-organization', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'members'));

test('getMemberRoles() issues an appropriate request', function(): void {
    $this->endpoint->getMemberRoles('test-organization', 'test-user');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles');
});

test('getMemberRoles() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getMemberRoles('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getMemberRoles() throws an exception when an invalid `userId` is used', function(): void {
    $this->endpoint->getMemberRoles('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

test('addMemberRoles() issues an appropriate request', function(): void {
    $this->endpoint->addMemberRoles('test-organization', 'test-user', ['test-role']);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    expect($body['roles'])->toContain('test-role');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['roles' => ['test-role']]));
});

test('addMemberRoles() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->addMemberRoles('', '', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('addMemberRoles() throws an exception when an invalid `userId` is used', function(): void {
    $this->endpoint->addMemberRoles('test-organization', '', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

test('addMemberRoles() throws an exception when an invalid `roles` is used', function(): void {
    $this->endpoint->addMemberRoles('test-organization', 'test-rule', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'roles'));

test('removeMemberRoles() issues an appropriate request', function(): void {
    $this->endpoint->removeMemberRoles('test-organization', 'test-user', ['test-role']);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/members/test-user/roles');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('roles', $body);
    expect($body['roles'])->toContain('test-role');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['roles' => ['test-role']]));
});

test('removeMemberRoles() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->removeMemberRoles('', '', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('removeMemberRoles() throws an exception when an invalid `userId` is used', function(): void {
    $this->endpoint->removeMemberRoles('test-organization', '', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'userId'));

test('removeMemberRoles() throws an exception when an invalid `roles` is used', function(): void {
    $this->endpoint->removeMemberRoles('test-organization', 'test-rule', []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'roles'));

test('getInvitations() issues an appropriate request', function(): void {
    $this->endpoint->getInvitations('test-organization');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/invitations');
});

test('getInvitations() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getInvitations('');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getInvitation() issues an appropriate request', function(): void {
    $this->endpoint->getInvitation('test-organization', 'test-invitation');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation');
});

test('getInvitation() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->getInvitation('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('getInvitation() throws an exception when an invalid `invitationId` is used', function(): void {
    $this->endpoint->getInvitation('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitationId'));

test('createInvitation() issues an appropriate request', function(): void {
    $this->endpoint->createInvitation(
        'test-organization',
        'test-client',
        ['name' => 'Test Sender'],
        ['email' => 'email@test.com']
    );

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/invitations');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('client_id', $body);
    expect($body['client_id'])->toEqual('test-client');
    $this->assertArrayHasKey('inviter', $body);
    $this->assertArrayHasKey('name', $body['inviter']);
    expect($body['inviter']['name'])->toEqual('Test Sender');
    $this->assertArrayHasKey('invitee', $body);
    $this->assertArrayHasKey('email', $body['invitee']);
    expect($body['invitee']['email'])->toEqual('email@test.com');

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['client_id' => 'test-client', 'inviter' => ['name' => 'Test Sender'], 'invitee' => ['email' => 'email@test.com']]));
});

test('createInvitation() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->createInvitation('', '', [], []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('createInvitation() throws an exception when an invalid `clientId` is used', function(): void {
    $this->endpoint->createInvitation('test-organization', '', [], []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'clientId'));

test('createInvitation() throws an exception when an invalid `inviter` is used', function(): void {
    $this->endpoint->createInvitation('test-organization', 'test-client', [], []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'inviter'));

test('createInvitation() throws an exception when an invalid `invitee` is used', function(): void {
    $this->endpoint->createInvitation('test-organization', 'test-client', ['test' => 'test'], []);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitee'));

test('createInvitation() throws an exception when an invalid `inviter.name` is used', function(): void {
    $this->endpoint->createInvitation('test-organization', 'test-client', ['test' => 'test'], ['test' => 'test']);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'inviter.name'));

test('createInvitation() throws an exception when an invalid `invitee.email` is used', function(): void {
    $this->endpoint->createInvitation('test-organization', 'test-client', ['name' => 'Test Sender'], ['test' => 'test']);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitee.email'));

test('deleteInvitation() issues an appropriate request', function(): void {
    $this->endpoint->deleteInvitation('test-organization', 'test-invitation');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/organizations/test-organization/invitations/test-invitation');
});

test('deleteInvitation() throws an exception when an invalid `id` is used', function(): void {
    $this->endpoint->deleteInvitation('', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

test('deleteInvitation() throws an exception when an invalid `invitationId` is used', function(): void {
    $this->endpoint->deleteInvitation('test-organization', '');
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'invitationId'));
