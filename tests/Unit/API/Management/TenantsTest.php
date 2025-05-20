<?php

declare(strict_types=1);

uses()->group('management', 'management.tenants');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->tenants();
});

test('get() issues an appropriate request', function(): void {
    $this->endpoint->getSettings();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/tenants/settings');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('update() issues an appropriate request', function(array $body): void {
    $this->endpoint->updateSettings($body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/tenants/settings');
    expect($this->api->getRequestQuery())->toBeEmpty();

    $request = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $request);
    expect($request['test'])->toEqual($body['test']);

    $request = $this->api->getRequestBodyAsString();
    expect($request)->toEqual(json_encode($body));
})->with(['mocked data' => [
    fn() => [ 'test' => uniqid() ],
]]);

test('update() issues an appropriate request for clients-only default_token_quota', function(): void {
    $mock = (object)[
        'body' => [
            'default_token_quota' => [
                'clients' => [
                    'client_credentials' => [
                        'per_day' => 10,
                        'enforce' => true,
                    ],
                ],
            ],
        ],
    ];

    $this->endpoint->updateSettings($mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/tenants/settings');

    $body = $this->api->getRequestBody();

    // Check for default_token_quota and clients only
    $this->assertArrayHasKey('default_token_quota', $body);
    $this->assertArrayHasKey('clients', $body['default_token_quota']);
    expect($body['default_token_quota']['clients']['client_credentials']['per_day'])
        ->toEqual($mock->body['default_token_quota']['clients']['client_credentials']['per_day']);

    // Ensure organizations is not present
    $this->assertArrayNotHasKey('organizations', $body['default_token_quota']);

    // Ensure the request body matches the expected JSON
    expect($this->api->getRequestBodyAsString())->toEqual(json_encode($mock->body));
});


test('updateSettings() issues an appropriate request for clients-only default_token_quota', function(): void {
    $mock = (object)[
        'body' => [
            'default_token_quota' => [
                'clients' => [
                    'client_credentials' => [
                        'per_day' => 10,
                        'enforce' => true,
                    ],
                ],
            ],
        ],
    ];

    $this->endpoint->updateSettings($mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/tenants/settings');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('default_token_quota', $body);
    $this->assertArrayHasKey('clients', $body['default_token_quota']);
    expect($body['default_token_quota']['clients']['client_credentials']['per_day'])
        ->toEqual($mock->body['default_token_quota']['clients']['client_credentials']['per_day']);


    $this->assertArrayNotHasKey('organizations', $body['default_token_quota']);


    expect($this->api->getRequestBodyAsString())->toEqual(json_encode($mock->body));
});

test('update() issues an appropriate request for organizations-only default_token_quota', function(): void {
    $mock = (object)[
        'body' => [
            'default_token_quota' => [
                'organizations' => [
                    'client_credentials' => [
                        'per_hour' => 5,
                        'enforce'  => false,
                    ],
                ],
            ],
        ],
    ];

    $this->endpoint->updateSettings($mock->body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEndWith('/api/v2/tenants/settings');

    $body = $this->api->getRequestBody();

    $this->assertArrayHasKey('default_token_quota', $body);
    $this->assertArrayHasKey('organizations', $body['default_token_quota']);

    expect($body['default_token_quota']['organizations']['client_credentials']['per_hour'])
        ->toEqual($mock->body['default_token_quota']['organizations']['client_credentials']['per_hour']);
    expect($body['default_token_quota']['organizations']['client_credentials']['enforce'])
        ->toEqual($mock->body['default_token_quota']['organizations']['client_credentials']['enforce']);


    $this->assertArrayNotHasKey('clients', $body['default_token_quota']);


    expect($this->api->getRequestBodyAsString())->toEqual(json_encode($mock->body));
});
