<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Header;

use Auth0\SDK\API\Header\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\ForwardedFor;
use Auth0\SDK\API\Header\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{
    public function testHeader(): void
    {
        $headerName = 'HEADERNAME';
        $value = 'THISISTHEVALUE';

        $header = new Header($headerName, $value);

        $this->assertEquals($headerName, $header->getHeader());
        $this->assertEquals($value, $header->getValue());
        $this->assertEquals("$headerName: $value\n", $header->get());
    }

    public function testAuthorizationBearer(): void
    {
        $token = 'THISISTHETOKEN';
        $header = new AuthorizationBearer($token);

        $this->assertEquals('Authorization', $header->getHeader());
        $this->assertEquals("Bearer $token", $header->getValue());
        $this->assertEquals("Authorization: Bearer $token\n", $header->get());
    }

    public function testContentType(): void
    {
        $contentType = 'CONTENT/TYPE';
        $header = new ContentType($contentType);

        $this->assertEquals('Content-Type', $header->getHeader());
        $this->assertEquals($contentType, $header->getValue());
        $this->assertEquals("Content-Type: $contentType\n", $header->get());
    }

    public function testForwardedFor(): void
    {
        $forwardedForVal = uniqid();
        $header = new ForwardedFor($forwardedForVal);

        $this->assertEquals('Auth0-Forwarded-For', $header->getHeader());
        $this->assertEquals($forwardedForVal, $header->getValue());
        $this->assertEquals("Auth0-Forwarded-For: $forwardedForVal\n", $header->get());
    }
}
