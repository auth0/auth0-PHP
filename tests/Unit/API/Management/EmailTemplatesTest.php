<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'emailtemplates');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();

    $this->filteredRequest = new FilteredRequest();
    $this->paginatedRequest = new PaginatedRequest();
    $this->requestOptions = new RequestOptions(
        $this->filteredRequest,
        $this->paginatedRequest
    );
});

test('create() throws an error when missing required variables', function(): void {
    $endpoint = $this->sdk->mock()->emailTemplates();

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'template'));

    $endpoint->create('', '', '', '', '', false);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $endpoint->create(uniqid(), '', '', '' , '', false);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'from'));

    $endpoint->create(uniqid(), uniqid(), '', '' , '', false);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'subject'));

    $endpoint->create(uniqid(), uniqid(), uniqid(), '', '', false);

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'syntax'));

    $endpoint->create(uniqid(), uniqid(), uniqid(), uniqid(), '', false);
});

test('create() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emailTemplates();

    $template = uniqid();
    $payload = uniqid();
    $from = uniqid();
    $subject = uniqid();
    $syntax = uniqid();

    $endpoint->create($template, $payload, $from, $subject, $syntax, true);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates', $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('template', $body);
    $this->assertArrayHasKey('body', $body);
    $this->assertArrayHasKey('from', $body);
    $this->assertArrayHasKey('subject', $body);
    $this->assertArrayHasKey('syntax', $body);
    $this->assertArrayHasKey('enabled', $body);
    $this->assertEquals($template, $body['template']);
    $this->assertEquals($payload, $body['body']);
    $this->assertEquals($from, $body['from']);
    $this->assertEquals($subject, $body['subject']);
    $this->assertEquals($syntax, $body['syntax']);
    $this->assertEquals(true, $body['enabled']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['template' => $template, 'body' => $payload, 'from' => $from, 'subject' => $subject, 'syntax' => $syntax, 'enabled' => true]), $body);
});

test('get() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emailTemplates();

    $templateName = uniqid();

    $endpoint->get($templateName);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/email-templates/' . $templateName, $this->sdk->getRequestUrl());
});

test('update() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emailTemplates();

    $templateName = uniqid();
    $payload = uniqid();

    $endpoint->update($templateName, ['test' => $payload]);

    $this->assertEquals('PUT', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates/' . $templateName, $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    $this->assertEquals($payload, $body['test']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['test' => $payload]), $body);
});

test('patch() issues valid requests', function(): void {
    $endpoint = $this->sdk->mock()->emailTemplates();

    $templateName = uniqid();
    $payload = uniqid();

    $endpoint->patch($templateName, ['test' => $payload]);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates/' . $templateName, $this->sdk->getRequestUrl());

    $body = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    $this->assertEquals($payload, $body['test']);

    $body = $this->sdk->getRequestBodyAsString();
    $this->assertEquals(json_encode(['test' => $payload]), $body);
});
