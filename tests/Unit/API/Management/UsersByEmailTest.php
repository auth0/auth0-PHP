<?php

declare(strict_types=1);

uses()->group('management', 'management.users_by_email');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->usersByEmail();
});

test('get() issues an appropriate request', function(string $email): void {
    $this->endpoint->get($email);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/users-by-email', $this->api->getRequestUrl());
    $this->assertStringContainsString(http_build_query(['email' => $email], '', '&', PHP_QUERY_RFC1738), $this->api->getRequestQuery(null));
})->with(['mocked id' => [
    fn() => uniqid() . '@somewhere.somehow',
]]);
