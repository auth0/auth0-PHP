<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\Tests\Utilities\MockManagementApi;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailTemplatesMockedTest.
 */
class EmailTemplatesMockedTest extends TestCase
{
    public function testGet(): void
    {
        $api = new MockManagementApi();
        $api->mock()->emailTemplates()->get('verify_email');

        $this->assertEquals('GET', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates/verify_email', $api->getRequestUrl());
    }

    public function testPatch(): void
    {
        $patch_data = [
            'body' => '__test_email_body__',
            'from' => 'test@auth0.com',
            'resultUrl' => 'https://auth0.com',
            'subject' => '__test_email_subject__',
        ];

        $api = new MockManagementApi();
        $api->mock()->emailTemplates()->patch('reset_email', $patch_data);

        $this->assertEquals('PATCH', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates/reset_email', $api->getRequestUrl());

        $this->assertEquals($patch_data, $api->getRequestBody());
    }

    public function testCreate(): void
    {
        $api = new MockManagementApi();
        $api->mock()->emailTemplates()->create(
            'welcome_email',
            '__test_email_body__',
            'test@auth0.com',
            '__test_email_subject__',
            'liquid',
            true,
            [
                'urlLifetimeInSeconds' => 0,
            ]
        );

        $this->assertEquals('POST', $api->getRequestMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates', $api->getRequestUrl());

        $body = $api->getRequestBody();
        $this->assertArrayHasKey('template', $body);
        $this->assertEquals('welcome_email', $body['template']);
        $this->assertArrayHasKey('enabled', $body);
        $this->assertEquals(true, $body['enabled']);
        $this->assertArrayHasKey('from', $body);
        $this->assertEquals('test@auth0.com', $body['from']);
        $this->assertArrayHasKey('subject', $body);
        $this->assertEquals('__test_email_subject__', $body['subject']);
        $this->assertArrayHasKey('body', $body);
        $this->assertEquals('__test_email_body__', $body['body']);
        $this->assertArrayHasKey('syntax', $body);
        $this->assertEquals('liquid', $body['syntax']);
        $this->assertArrayHasKey('urlLifetimeInSeconds', $body);
        $this->assertEquals(0, $body['urlLifetimeInSeconds']);
    }
}
