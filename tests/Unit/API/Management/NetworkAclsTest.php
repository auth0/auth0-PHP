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
        'priority' => 123,
        'rule' => [
            'protocol' => 'http',
            'port' => 80,
            'source_ip_range' => '192.168.1.0/24',
            'action' => 'allow',
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
    expect($body['rule'])->toEqual($mock->rule);
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
            'priority' => 456
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
