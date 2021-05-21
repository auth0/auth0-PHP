<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

class BlacklistsTest extends TestCase
{
    public function testGet(): void
    {
        $api = new MockManagementApi();
        $api->mock()->blacklists()->get('__test_aud__');
        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertStringStartsWith('https://api.test.local/api/v2/blacklists/tokens', $api->getRequestUrl());

        $this->assertEquals('aud=__test_aud__', $api->getRequestQuery(null));
    }

    public function testBlacklist(): void
    {
        $api = new MockManagementApi();

        $api->mock()->blacklists()->create('__test_jti__', '__test_aud__');

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/blacklists/tokens', $api->getRequestUrl());
        $this->assertEmpty($api->getRequestQuery());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('aud', $body);
        $this->assertEquals('__test_aud__', $body['aud']);
        $this->assertArrayHasKey('jti', $body);
        $this->assertEquals('__test_jti__', $body['jti']);
    }
}
