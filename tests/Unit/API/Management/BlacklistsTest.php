<?php

declare(strict_types=1);

uses()->group('management', 'management.blacklists');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->blacklists();
});

test('create() issues an appropriate request', function(): void {
    $jti = uniqid();
    $aud = uniqid();

    $this->endpoint->create($jti, $aud);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/blacklists/tokens', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('aud', $body);
    $this->assertEquals($aud, $body['aud']);
    $this->assertArrayHasKey('jti', $body);
    $this->assertEquals($jti, $body['jti']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['jti' => $jti, 'aud' => $aud]), $body);
});

test('get() issues valid requests', function(): void {
    $aud = uniqid();

    $this->endpoint->get($aud);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/blacklists/tokens', $this->api->getRequestUrl());

    $this->assertEquals('aud=' . $aud, $this->api->getRequestQuery(null));
});
