<?php

declare(strict_types=1);

use Auth0\SDK\Event\HttpRequestBuilt;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

uses()->group('event', 'event.http_request_built');

it('handles RequestInterface properly', function (): void {
    $request1 = new class() implements RequestInterface {
        public bool $test = false;
        public function getProtocolVersion(): void
        {
        }
        public function withProtocolVersion(
            $version
        ): void {
        }
        public function getHeaders(): void
        {
        }
        public function hasHeader(
            $name
        ): void {
        }
        public function getHeader(
            $name
        ): void {
        }
        public function getHeaderLine(
            $name
        ): void {
        }
        public function withHeader(
            $name,
            $value
        ): void {
        }
        public function withAddedHeader(
            $name,
            $value
        ): void {
        }
        public function withoutHeader(
            $name
        ): void {
        }
        public function getBody(): void
        {
        }
        public function withBody(
            StreamInterface $body
        ): void {
        }
        public function getRequestTarget(): void
        {
        }
        public function withRequestTarget(
            $requestTarget
        ): void {
        }
        public function getMethod(): void
        {
        }
        public function withMethod(
            $method
        ): void {
        }
        public function getUri(): void
        {
        }
        public function withUri(
            UriInterface $uri,
            $preserveHost = false
        ): void {
        }
    };

    $request2 = clone $request1;
    $request2->test = true;

    $event = new HttpRequestBuilt($request1);
    expect($event->get())->toEqual($request1);

    $event->set($request2);
    expect($event->get())->toEqual($request2);
});
