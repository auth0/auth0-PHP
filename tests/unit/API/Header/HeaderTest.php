<?php

namespace Auth0\Tests\unit\API\Header;

use Auth0\SDK\API\Header\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\ForwardedFor;
use Auth0\SDK\API\Header\Header;
use Auth0\SDK\API\Header\Telemetry;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase
{

    public function testHeader()
    {
        $headerName = 'HEADERNAME';
        $value      = 'THISISTHEVALUE';

        $header = new Header($headerName, $value);

        $this->assertEquals($headerName, $header->getHeader());
        $this->assertEquals($value, $header->getValue());
        $this->assertEquals("$headerName: $value\n", $header->get());
    }

    public function testAuthorizationBearer()
    {
        $token  = 'THISISTHETOKEN';
        $header = new AuthorizationBearer($token);

        $this->assertEquals('Authorization', $header->getHeader());
        $this->assertEquals("Bearer $token", $header->getValue());
        $this->assertEquals("Authorization: Bearer $token\n", $header->get());
    }

    public function testContentType()
    {
        $contentType = 'CONTENT/TYPE';
        $header      = new ContentType($contentType);

        $this->assertEquals('Content-Type', $header->getHeader());
        $this->assertEquals($contentType, $header->getValue());
        $this->assertEquals("Content-Type: $contentType\n", $header->get());
    }

    public function testTelemetry()
    {
        $telemetryVal = uniqid();
        $header       = new Telemetry($telemetryVal);

        $this->assertEquals('Auth0-Client', $header->getHeader());
        $this->assertEquals($telemetryVal, $header->getValue());
        $this->assertEquals("Auth0-Client: $telemetryVal\n", $header->get());
    }

    public function testForwardedFor()
    {
        $forwardedForVal = uniqid();
        $header          = new ForwardedFor($forwardedForVal);

        $this->assertEquals('Auth0-Forwarded-For', $header->getHeader());
        $this->assertEquals($forwardedForVal, $header->getValue());
        $this->assertEquals("Auth0-Forwarded-For: $forwardedForVal\n", $header->get());
    }
}
