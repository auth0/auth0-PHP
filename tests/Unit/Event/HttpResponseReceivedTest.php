<?php

declare(strict_types=1);

use Auth0\SDK\Event\HttpResponseReceived;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

uses()->group('event', 'event.http_response_received');

it('handles RequestInterface properly', function(): void {
    $request1 = new class() implements RequestInterface {
        public bool $test = false;
        public function getProtocolVersion() {}
        public function withProtocolVersion($version) {}
        public function getHeaders() {}
        public function hasHeader($name) {}
        public function getHeader($name) {}
        public function getHeaderLine($name) {}
        public function withHeader($name, $value) {}
        public function withAddedHeader($name, $value) {}
        public function withoutHeader($name) {}
        public function getBody() {}
        public function withBody(StreamInterface $body) {}
        public function getRequestTarget() {}
        public function withRequestTarget($requestTarget) {}
        public function getMethod() {}
        public function withMethod($method) {}
        public function getUri() {}
        public function withUri(UriInterface $uri, $preserveHost = false) {}
    };

    $request2 = clone $request1;
    $request2->test = true;

    $response1 = new class() implements ResponseInterface {
        public bool $test = false;
        public function getProtocolVersion() {}
        public function withProtocolVersion($version) {}
        public function getHeaders() {}
        public function hasHeader($name) {}
        public function getHeader($name) {}
        public function getHeaderLine($name) {}
        public function withHeader($name, $value) {}
        public function withAddedHeader($name, $value) {}
        public function withoutHeader($name) {}
        public function getBody() {}
        public function withBody(StreamInterface $body) {}
        public function getStatusCode() {}
        public function withStatus($code, $reasonPhrase = '') {}
        public function getReasonPhrase() {}
    };

    $response2 = clone($response1);
    $response2->test = true;

    $event = new HttpResponseReceived($response1, $request1);
    expect($event->get())->toEqual($response1);

    expect($event->getRequest())->toEqual($request1);
    $this->assertNotEquals($request2, $event->getRequest());

    $event->set($response2);
    expect($event->get())->toEqual($response2);
    $this->assertNotEquals($response1, $event->get());
});
