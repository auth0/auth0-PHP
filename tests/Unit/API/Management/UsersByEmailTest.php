<?php

declare(strict_types=1);

uses()->group('management', 'management.users_by_email');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->usersByEmail();
});

test('get() issues an appropriate request', function(string $email): void {
    $this->endpoint->get($email);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/users-by-email');
    expect($this->api->getRequestQuery(null))->toContain(http_build_query(['email' => $email], '', '&', PHP_QUERY_RFC1738));
})->with(['mocked id' => [
    fn() => uniqid() . '@somewhere.somehow',
]]);
