<?php

declare(strict_types=1);

uses()->group('management', 'management.refresh_tokens');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->refreshTokens();
});

test('get() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->get($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/refresh-tokens/' . $id);
});

test('delete() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->delete($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/refresh-tokens/' . $id);

    $headers = $this->api->getRequestHeaders();
    expect($headers['Content-Type'][0])->toEqual('application/json');
});