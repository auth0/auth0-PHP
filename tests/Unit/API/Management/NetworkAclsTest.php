<?php

declare(strict_types=1);

uses()->group('management', 'management.network_acls');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->networkAcls();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/network-acls');
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->get('123');

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/network-acls/123');
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'description' => uniqid(),
        'active' => true,
        'priority' => 10,
        'rule' => [
            'action' => [
                'block' => true,
                'allow' => true,
                'log' => true,
                'redirect' => true,
                'redirect_uri' => 'https://example.com'
            ],
            'match' => [
                'ipv4_cidrs' => [
                    '198.51.100.42',
                    '10.0.0.0/24'
                ],
                'ipv6_cidrs' => [
                    '2001:0db8:5b96:0000:0000:426f:8e17:642a',
                    '2002::1234:abcd:ffff:c0a8:101/64'
                ],
                'geo_country_codes' => ['US', 'CA']
            ],
            'scope' => 'management'
        ],
        'additional' => [
            'custom_field' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->description, $mock->active, $mock->priority, $mock->rule, $mock->additional);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/network-acls');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual($mock->description);
    $this->assertArrayHasKey('active', $body);
    expect($body['active'])->toEqual($mock->active);
    $this->assertArrayHasKey('priority', $body);
    expect($body['priority'])->toEqual($mock->priority);
    $this->assertArrayHasKey('rule', $body);
    expect($body['rule'])->toBeArray();
    
    // Verify rule action properties
    $this->assertArrayHasKey('action', $body['rule']);
    expect($body['rule']['action'])->toBeArray();
    expect($body['rule']['action']['block'])->toEqual($mock->rule['action']['block']);
    expect($body['rule']['action']['allow'])->toEqual($mock->rule['action']['allow']);
    expect($body['rule']['action']['log'])->toEqual($mock->rule['action']['log']);
    expect($body['rule']['action']['redirect'])->toEqual($mock->rule['action']['redirect']);
    expect($body['rule']['action']['redirect_uri'])->toEqual($mock->rule['action']['redirect_uri']);
    
    // Verify rule match properties
    $this->assertArrayHasKey('match', $body['rule']);
    expect($body['rule']['match'])->toBeArray();
    expect($body['rule']['match']['ipv4_cidrs'])->toEqual($mock->rule['match']['ipv4_cidrs']);
    expect($body['rule']['match']['ipv6_cidrs'])->toEqual($mock->rule['match']['ipv6_cidrs']);
    expect($body['rule']['match']['geo_country_codes'])->toEqual($mock->rule['match']['geo_country_codes']);
    
    // Verify rule scope
    expect($body['rule']['scope'])->toEqual($mock->rule['scope']);
    $this->assertArrayHasKey('custom_field', $body);
    expect($body['custom_field'])->toEqual($mock->additional['custom_field']);

    $bodyAsString = $this->api->getRequestBodyAsString();
    $expectedBody = json_encode(array_merge([
        'description' => $mock->description,
        'active' => $mock->active,
        'priority' => $mock->priority,
        'rule' => $mock->rule,
    ], $mock->additional));
    expect($bodyAsString)->toEqual($expectedBody);
});

test('update() issues an appropriate request', function(): void {
    $mock = (object) [
        'id' => uniqid(),
        'body' => [
            'description' => uniqid(),
            'active' => false,
            'priority' => 10
        ]
    ];

    $this->endpoint->update($mock->id, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('PUT');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/network-acls/' . $mock->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual($mock->body['description']);
    $this->assertArrayHasKey('active', $body);
    expect($body['active'])->toEqual($mock->body['active']);
    $this->assertArrayHasKey('priority', $body);
    expect($body['priority'])->toEqual($mock->body['priority']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mock->body));
});

test('patch() issues an appropriate request', function(): void {
    $mock = (object) [
        'id' => uniqid(),
        'body' => [
            'description' => uniqid(),
            'active' => true
        ]
    ];

    $this->endpoint->patch($mock->id, $mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/network-acls/' . $mock->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual($mock->body['description']);
    $this->assertArrayHasKey('active', $body);
    expect($body['active'])->toEqual($mock->body['active']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mock->body));
});

test('delete() issues an appropriate request', function(): void {
    $this->endpoint->delete('123');

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/network-acls/123');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});
