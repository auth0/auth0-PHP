<?php

declare(strict_types=1);

uses()->group('management', 'management.email_templates');

beforeEach(function(): void {
    $this->endpoint = $this->api->mock()->emailTemplates();
});

test('create() throws an error when missing `template`', function(): void {
    $this->endpoint->create('', '', '', '', '', false);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'template'));


test('create() throws an error when missing `body`', function(): void {
    $this->endpoint->create(uniqid(), '', '', '' , '', false);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));


test('create() throws an error when missing `from`', function(): void {
    $this->endpoint->create(uniqid(), uniqid(), '', '' , '', false);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'from'));


test('create() throws an error when missing `subject`', function(): void {
    $this->endpoint->create(uniqid(), uniqid(), uniqid(), '', '', false);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'subject'));


test('create() throws an error when missing `syntax`', function(): void {
    $this->endpoint->create(uniqid(), uniqid(), uniqid(), uniqid(), '', false);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'syntax'));

test('create() issues valid requests', function(): void {
    $template = uniqid();
    $payload = uniqid();
    $from = uniqid();
    $subject = uniqid();
    $syntax = uniqid();

    $this->endpoint->create($template, $payload, $from, $subject, $syntax, true);

    expect($this->api->getRequestMethod())->toEqual('POST');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/email-templates');

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('template', $body);
    $this->assertArrayHasKey('body', $body);
    $this->assertArrayHasKey('from', $body);
    $this->assertArrayHasKey('subject', $body);
    $this->assertArrayHasKey('syntax', $body);
    $this->assertArrayHasKey('enabled', $body);
    expect($body['template'])->toEqual($template);
    expect($body['body'])->toEqual($payload);
    expect($body['from'])->toEqual($from);
    expect($body['subject'])->toEqual($subject);
    expect($body['syntax'])->toEqual($syntax);
    expect($body['enabled'])->toEqual(true);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['template' => $template, 'body' => $payload, 'from' => $from, 'subject' => $subject, 'syntax' => $syntax, 'enabled' => true]));
});

test('get() issues valid requests', function(): void {
    $templateName = uniqid();

    $this->endpoint->get($templateName);

    expect($this->api->getRequestMethod())->toEqual('GET');
    expect($this->api->getRequestUrl())->toStartWith('https://api.test.local/api/v2/email-templates/' . $templateName);
});

test('update() issues valid requests', function(): void {
    $templateName = uniqid();
    $payload = uniqid();

    $this->endpoint->update($templateName, ['test' => $payload]);

    expect($this->api->getRequestMethod())->toEqual('PUT');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/email-templates/' . $templateName);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    expect($body['test'])->toEqual($payload);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['test' => $payload]));
});

test('patch() issues valid requests', function(): void {
    $templateName = uniqid();
    $payload = uniqid();

    $this->endpoint->patch($templateName, ['test' => $payload]);

    expect($this->api->getRequestMethod())->toEqual('PATCH');
    expect($this->api->getRequestUrl())->toEqual('https://api.test.local/api/v2/email-templates/' . $templateName);

    $body = $this->api->getRequestBody();
    $this->assertArrayHasKey('test', $body);
    expect($body['test'])->toEqual($payload);

    $body = $this->api->getRequestBodyAsString();
    expect($body)->toEqual(json_encode(['test' => $payload]));
});
