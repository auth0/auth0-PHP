<?php

declare(strict_types=1);

uses()->group('management', 'management.rules');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->rules();
});

test('getAll() issues an appropriate request', function(): void {
    $this->endpoint->getAll(['enabled' => true]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/rules');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('enabled=true');
});

test('get() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->get($mockupId);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/rules/' . $mockupId);
});

test('delete() issues an appropriate request', function(): void {
    $mockupId = uniqid();

    $this->endpoint->delete($mockupId);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/rules/' . $mockupId);
});

test('create() issues an appropriate request', function(): void {
    $mockup = (object) [
        'name' => uniqid(),
        'script' => uniqid(),
        'query' => [ 'test_parameter' => uniqid() ],
    ];

    $this->endpoint->create($mockup->name, $mockup->script, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/rules');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mockup->name);

    $this->assertArrayHasKey('script', $body);
    expect($body['script'])->toEqual($mockup->script);

    $this->assertArrayHasKey('test_parameter', $body);
    expect($body['test_parameter'])->toEqual($mockup->query['test_parameter']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mockup->name, 'script' => $mockup->script], $mockup->query)));
});

test('update() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [ 'test_parameter' => uniqid() ],
    ];

    $this->endpoint->update($mockup->id, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/rules/' . $mockup->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test_parameter', $body);
    expect($body['test_parameter'])->toEqual($mockup->query['test_parameter']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
});
