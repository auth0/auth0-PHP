<?php

declare(strict_types=1);

uses()->group('management', 'management.connections');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->connections();
});

test('getAll() issues an appropriate request', function(): void {
    $strategy = uniqid();

    $this->endpoint->getAll([ 'strategy' => $strategy ]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toContain('https://api.test.local/api/v2/connections');
    expect($this->api->getRequestQuery())->toContain('&strategy=' . $strategy);
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/connections/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('delete() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/connections/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('deleteUser() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';
    $email = 'con_testConnection10@auth0.com';

    $this->endpoint->deleteUser($id, $email);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toContain('https://api.test.local/api/v2/connections/' . $id . '/users');
    expect($this->api->getRequestQuery(null))->toEqual('email=' . rawurlencode($email));
});

test('create() issues an appropriate request', function(): void {
    $mock = (object) [
        'name' => uniqid(),
        'strategy' => uniqid(),
        'body' => [
            'test1' => uniqid(),
            'test2' => uniqid()
        ]
    ];

    $this->endpoint->create($mock->name, $mock->strategy, $mock->body);

    $request_body = $this->api->getRequestBody();

    expect($request_body['name'])->toEqual($mock->name);
    expect($request_body['strategy'])->toEqual($mock->strategy);
    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/connections');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mock->name, 'strategy' => $mock->strategy], $mock->body)));
});

test('update() issues an appropriate request', function(): void {
    $id = 'con_testConnection10';
    $update_data = ['metadata' => ['meta1' => 'value1']];

    $this->endpoint->update($id, $update_data);

    $request_body = $this->api->getRequestBody();

    expect($request_body)->toEqual($update_data);
    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/connections/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});
