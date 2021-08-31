<?php

declare(strict_types=1);

uses()->group('management', 'management.guardian');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->guardian();
});

test('getFactors() issues an appropriate request', function(): void {
    $this->endpoint->getFactors();

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/guardian/factors');
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('getEnrollment() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getEnrollment($id);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/guardian/enrollments/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});

test('deleteEnrollment() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->deleteEnrollment($id);

    expect($this->api->getRequestMethod())->toEqual('DELETE');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/guardian/enrollments/' . $id);
    expect($this->api->getRequestQuery())->toBeEmpty();
});
