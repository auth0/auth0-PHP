<?php

namespace Auth0\Tests;

use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;
use Auth0\SDK\API\Header\Header;
use Auth0\SDK\API\Header\Telemetry;

class HeaderTest extends \PHPUnit_Framework_TestCase
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
        $telemetry = uniqid();
        $header    = new Telemetry($telemetry);

        $this->assertEquals('Auth0-Client', $header->getHeader());
        $this->assertEquals($telemetry, $header->getValue());
        $this->assertEquals("Auth0-Client: $telemetry\n", $header->get());
    }
}
