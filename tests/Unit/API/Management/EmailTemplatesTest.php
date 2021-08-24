<?php

declare(strict_types=1);

uses()->group('management', 'management.email_templates');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->emailTemplates();
});

test('create() throws an error when missing `template`', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'template'));

    $this->endpoint->create('', '', '', '', '', false);
});


test('create() throws an error when missing `body`', function(): void {

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $this->endpoint->create(uniqid(), '', '', '' , '', false);
});


test('create() throws an error when missing `from`', function(): void {

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'from'));

    $this->endpoint->create(uniqid(), uniqid(), '', '' , '', false);
});


test('create() throws an error when missing `subject`', function(): void {

    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'subject'));

    $this->endpoint->create(uniqid(), uniqid(), uniqid(), '', '', false);
});


test('create() throws an error when missing `syntax`', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'syntax'));

    $this->endpoint->create(uniqid(), uniqid(), uniqid(), uniqid(), '', false);
});

test('create() issues valid requests', function(): void {
    $template = uniqid();
    $payload = uniqid();
    $from = uniqid();
    $subject = uniqid();
    $syntax = uniqid();

    $this->endpoint->create($template, $payload, $from, $subject, $syntax, true);

    $this->assertEquals('POST', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates', $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
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

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['template' => $template, 'body' => $payload, 'from' => $from, 'subject' => $subject, 'syntax' => $syntax, 'enabled' => true]), $body);
});

test('get() issues valid requests', function(): void {
    $templateName = uniqid();

    $this->endpoint->get($templateName);

    $this->assertEquals('GET', $this->api->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/email-templates/' . $templateName, $this->api->getRequestUrl());
});

test('update() issues valid requests', function(): void {
    $templateName = uniqid();
    $payload = uniqid();

    $this->endpoint->update($templateName, ['test' => $payload]);

    $this->assertEquals('PUT', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates/' . $templateName, $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    $this->assertEquals($payload, $body['test']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['test' => $payload]), $body);
});

test('patch() issues valid requests', function(): void {
    $templateName = uniqid();
    $payload = uniqid();

    $this->endpoint->patch($templateName, ['test' => $payload]);

    $this->assertEquals('PATCH', $this->api->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/email-templates/' . $templateName, $this->api->getRequestUrl());

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    $this->assertEquals($payload, $body['test']);

    $body = $this->api->getRequestBodyAsString();
    $this->assertEquals(json_encode(['test' => $payload]), $body);
});
