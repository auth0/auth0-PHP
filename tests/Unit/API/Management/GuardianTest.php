<?php

declare(strict_types=1);

uses()->group('management', 'management.guardian');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->guardian();
});

test('getFactors() issues an appropriate request', function(): void {
    $this->endpoint->getFactors();

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/guardian/factors', $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('getEnrollment() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->getEnrollment($id);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/guardian/enrollments/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});

test('deleteEnrollment() issues an appropriate request', function(): void {
    $id = uniqid();

    $this->endpoint->deleteEnrollment($id);

    $this->assertEquals('DELETE', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/guardian/enrollments/' . $id, $this->api->getRequestUrl());
    $this->assertEmpty($this->api->getRequestQuery());
});
