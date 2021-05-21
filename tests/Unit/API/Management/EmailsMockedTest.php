<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailsMockedTest.
 */
class EmailsMockedTest extends TestCase
{
    public function testGetProvider(): void
    {
        $api = new MockManagementApi();
        $request = $api->mock()->emails()->getProvider();

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/emails/provider', $api->getRequestUrl());
    }
}
