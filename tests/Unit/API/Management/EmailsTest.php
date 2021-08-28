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

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(5, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials']);
    $this->assertEquals($additional, $body['additional']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]), $body);
});

test('getProvider() issues valid requests', function(): void {
    $this->endpoint->getProvider();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/emails/provider', $this->api->getRequestUrl());
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

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('name', $body);
    $this->assertArrayHasKey('credentials', $body);
    $this->assertArrayHasKey('additional', $body);
    $this->assertCount(5, $body['credentials']);
    $this->assertEquals($name, $body['name']);
    $this->assertEquals($credentials, $body['credentials']);
    $this->assertEquals($additional, $body['additional']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['name' => $name, 'credentials' => $credentials, 'additional' => $additional]), $body);
});

test('delete() issues valid requests', function(): void {
    $this->endpoint->deleteProvider();

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/emails/provider', $this->api->getRequestUrl());
});
