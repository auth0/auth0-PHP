<?php

declare(strict_types=1);

uses()->group('management', 'management.attack_protection');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->attackProtection();
});

test('getBreachedPasswordDetection() issues valid requests', function(): void {
    $this->endpoint->getBreachedPasswordDetection();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/breached-password-detection');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('getBruteForceProtection() issues valid requests', function(): void {
    $this->endpoint->getBruteForceProtection();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/brute-force-protection');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('getSuspiciousIpThrottling() issues valid requests', function(): void {
    $this->endpoint->getSuspiciousIpThrottling();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/suspicious-ip-throttling');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('updateBreachedPasswordDetection() throws an error with an empty body', function(): void {
    $this->endpoint->updateBreachedPasswordDetection([]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

test('updateBruteForceProtection() throws an error with an empty body', function(): void {
    $this->endpoint->updateBruteForceProtection([]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

test('updateSuspiciousIpThrottling() throws an error with an empty body', function(): void {
    $this->endpoint->updateSuspiciousIpThrottling([]);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

test('updateBreachedPasswordDetection() issues valid requests', function(array $body): void {
    $this->endpoint->updateBreachedPasswordDetection($body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/breached-password-detection');
    expect($this->api->getRequestQuery())->toBeEmpty();

    expect($this->api->getRequestBody())
        ->toHaveKey('enabled')
        ->toHaveKey('shields')
        ->toHaveKey('admin_notification_frequency')
        ->toHaveKey('method')
        ->enabled
            ->toEqual(true)
        ->shields
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('block'),
                fn ($string) => $string->toEqual('admin_notification'),
            )
        ->admin_notification_frequency
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('immediately'),
                fn ($string) => $string->toEqual('weekly'),
            )
        ->method
            ->toEqual('standard');

    expect($this->api->getRequestBodyAsString())
        ->toEqual(json_encode($body))
        ->json();
})->with(['valid request' => [
    fn() => [
        'enabled' => true,
        'shields' => [
            'block',
            'admin_notification'
        ],
        'admin_notification_frequency' => [
            'immediately',
            'weekly'
        ],
        'method' => 'standard',
    ]
]]);

test('updateBruteForceProtection() issues valid requests', function(array $body): void {
    $this->endpoint->updateBruteForceProtection($body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/brute-force-protection');
    expect($this->api->getRequestQuery())->toBeEmpty();

    expect($this->api->getRequestBody())
        ->toHaveKey('enabled')
        ->toHaveKey('shields')
        ->toHaveKey('allowlist')
        ->toHaveKey('mode')
        ->toHaveKey('max_attempts')
        ->enabled
            ->toEqual(false)
        ->shields
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('block'),
                fn ($string) => $string->toEqual('user_notification'),
            )
        ->allowlist
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('143.204.0.105'),
                fn ($string) => $string->toEqual('2600:9000:208f:ca00:d:f5f5:b40:93a1'),
            )
        ->mode
            ->toEqual('count_per_identifier_and_ip')
        ->max_attempts
            ->toEqual(10);

    expect($this->api->getRequestBodyAsString())
        ->toEqual(json_encode($body))
        ->json();
})->with(['valid request' => [
    fn() => [
        'enabled' => false,
        'shields' => [
            'block',
            'user_notification'
        ],
        'allowlist' => [
            '143.204.0.105',
            '2600:9000:208f:ca00:d:f5f5:b40:93a1'
        ],
        'mode' => 'count_per_identifier_and_ip',
        'max_attempts' => 10
    ]
]]);

test('updateSuspiciousIpThrottling() issues valid requests', function(array $body): void {
    $this->endpoint->updateSuspiciousIpThrottling($body);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/attack-protection/suspicious-ip-throttling');
    expect($this->api->getRequestQuery())->toBeEmpty();

    expect($this->api->getRequestBody())
        ->toHaveKey('enabled')
        ->toHaveKey('shields')
        ->toHaveKey('allowlist')
        ->toHaveKey('stage')
        ->enabled
            ->toEqual(false)
        ->shields
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('block'),
                fn ($string) => $string->toEqual('admin_notification'),
            )
        ->allowlist
            ->toBeArray()
            ->toHaveLength(2)
            ->sequence(
                fn ($string) => $string->toEqual('143.204.0.105'),
                fn ($string) => $string->toEqual('2600:9000:208f:ca00:d:f5f5:b40:93a1'),
            )
        ->stage
            ->toBeArray()
            ->toHaveKey('pre-login')
            ->toHaveKey('pre-user-registration');

    expect($this->api->getRequestBody()['stage']['pre-login'])
        ->toBeArray()
        ->sequence(
            fn ($value, $key) => $key->toEqual('max_attempts') && $value->toEqual(100),
            fn ($value, $key) => $key->toEqual('rate') && $value->toEqual(864000),
        );

    expect($this->api->getRequestBody()['stage']['pre-user-registration'])
        ->toBeArray()
        ->sequence(
            fn ($value, $key) => $key->toEqual('max_attempts') && $value->toEqual(50),
            fn ($value, $key) => $key->toEqual('rate') && $value->toEqual(1728000),
        );

    expect($this->api->getRequestBodyAsString())
        ->toEqual(json_encode($body))
        ->json();
})->with(['valid request' => [
    fn() => [
        'enabled' => false,
        'shields' => [
            'block',
            'admin_notification'
        ],
        'allowlist' => [
            '143.204.0.105',
            '2600:9000:208f:ca00:d:f5f5:b40:93a1'
        ],
        'stage' => [
            'pre-login' => [
                'max_attempts' => 100,
                'rate' => 864000,
            ],
            'pre-user-registration' => [
                'max_attempts' => 50,
                'rate' => 1728000,
            ],
        ]
    ]
]]);
