<?php

declare(strict_types=1);

uses()->group('management', 'management.self-service-profiles');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->selfServiceProfiles();
});

test('getAll() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getAll(['test' => $id]);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://' . $this->api->mock()->getConfiguration()->getDomain() . '/api/v2/self-service-profiles');

    $query = $this->api->getRequestQuery();
    expect($query)->toContain('&test=' . $id);
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $id);
});

test('update() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [
            'name' => uniqid(),
            'description' => uniqid(),
            'user_attributes' => [
                '__test_meta_key__' => uniqid(),
            ],
        ],
    ];

    $this->endpoint->update($mockup->id, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $mockup->id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mockup->query['name']);
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual($mockup->query['description']);
    $this->assertArrayHasKey('user_attributes', $body);
    $this->assertArrayHasKey('__test_meta_key__', $body['user_attributes']);
    expect($body['user_attributes']['__test_meta_key__'])->toEqual($mockup->query['user_attributes']['__test_meta_key__']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
});

test('create() issues an appropriate request', function(): void {
    $mockup = (object) [
        'name' => uniqid(),
        'query' => [
            'description' => uniqid(),
        ],
    ];

    $this->endpoint->create($mockup->name, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    expect($body['name'])->toEqual($mockup->name);
    $this->assertArrayHasKey('description', $body);
    expect($body['description'])->toEqual($mockup->query['description']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(array_merge(['name' => $mockup->name], $mockup->query)));
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});

test('getCustomTextForProfile() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'language' => uniqid(),
        'page' => uniqid(),
    ];

    $this->endpoint->getCustomTextForProfile($mockup->id, $mockup->language, $mockup->page);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $mockup->id . '/custom-text/' . $mockup->language . '/' . $mockup->page);
});

test('setCustomTextForProfile() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'language' => uniqid(),
        'page' => uniqid(),
        'query' => [
            'text' => uniqid(),
        ],
    ];

    $this->endpoint->setCustomTextForProfile($mockup->id, $mockup->language, $mockup->page, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('PUT');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $mockup->id . '/custom-text/' . $mockup->language . '/' . $mockup->page);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('text', $body);
    expect($body['text'])->toEqual($mockup->query['text']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
});

test('createSsoTicket() issues an appropriate request', function(): void {
    $mockup = (object) [
        'id' => uniqid(),
        'query' => [
            'connection_id' => uniqid(),
        ],
    ];

    $this->endpoint->createSsoTicket($mockup->id, $mockup->query);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $mockup->id . '/sso-ticket');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('connection_id', $body);
    expect($body['connection_id'])->toEqual($mockup->query['connection_id']);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode($mockup->query));
});

test('revokeSsoTicket() issues an appropriate request', function(): void {
    $id = uniqid();
    $prfileId = uniqid();

    $this->endpoint->revokeSsoTicket($id, $prfileId);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/self-service-profiles/' . $id . '/sso-ticket/' . $prfileId . '/revoke');

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});
