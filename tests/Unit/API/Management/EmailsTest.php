<?php

declare(strict_types=1);

uses()->group('management', 'management.emails');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->emails();
});

test('createProvider() throws an error when missing required arguments', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'name'));

    $this->endpoint->createProvider('', []);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'credentials'));

    $this->endpoint->createProvider(uniqid(), []);
});

test('createProvider() issues valid requests', function(): void {
    $name = uniqid();
    $credentials = [
        'api_user' => uniqid(),
        'region' => uniqid(),
        'smtp_host' => uniqid(),
        'smtp_port' => uniqid(),
        'smtp_user' => uniqid()
    ];
    $additional = [
        'test1' => uniqid(),
        'test2' => uniqid(),
    ];

    $this->endpoint->createProvider($name, $credentials, ['additional' => $additional]);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/emails/provider');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    expect($body['credentials'])->toHaveCount(5);
    expect($body['name'])->toEqual($name);
    expect($body['credentials'])->toEqual($credentials);
    expect($body['additional'])->toEqual($additional);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]));
});

test('getProvider() issues valid requests', function(): void {
    $this->endpoint->getProvider();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/emails/provider');
});

test('updateProvider() issues valid requests', function(): void {
    $name = uniqid();
    $credentials = [
        'api_user' => uniqid(),
        'region' => uniqid(),
        'smtp_host' => uniqid(),
        'smtp_port' => uniqid(),
        'smtp_user' => uniqid()
    ];
    $additional = [
        'test1' => uniqid(),
        'test2' => uniqid(),
    ];

    $this->endpoint->updateProvider($name, $credentials, ['additional' => $additional]);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/emails/provider');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    expect($body['credentials'])->toHaveCount(5);
    expect($body['name'])->toEqual($name);
    expect($body['credentials'])->toEqual($credentials);
    expect($body['additional'])->toEqual($additional);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]));
});

test('delete() issues valid requests', function(): void {
    $this->endpoint->deleteProvider();

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/emails/provider');
});
