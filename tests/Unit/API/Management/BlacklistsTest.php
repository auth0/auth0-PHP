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

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/blacklists/tokens');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('aud', $body);
    expect($body['aud'])->toEqual($aud);
    $this->assertArrayHasKey('jti', $body);
    expect($body['jti'])->toEqual($jti);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['jti' => $jti, 'aud' => $aud]));
});

test('get() issues valid requests', function(): void {
    $aud = uniqid();

    $this->endpoint->get($aud);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/blacklists/tokens');

    expect($this->api->getRequestQuery(null))->toEqual('aud=' . $aud);
});
