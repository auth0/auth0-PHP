<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Management;

use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\Traits\ErrorHelpers;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class EmailTemplatesMockedTest.
 */
class EmailTemplatesMockedTest extends TestCase
{
    use ErrorHelpers;

    /**
     * Expected telemetry value.
     */
    protected static string $expectedTelemetry;

    /**
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass(): void
    {
        $infoHeadersData = new InformationHeaders();
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    public function testGet(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);
        $api->call()->emailTemplates()->get('verify_email');

        $this->assertEquals('GET', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates/verify_email', $api->getHistoryUrl());
    }

    public function testPatch(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);
        $patch_data = [
            'body' => '__test_email_body__',
            'from' => 'test@auth0.com',
            'resultUrl' => 'https://auth0.com',
            'subject' => '__test_email_subject__',
        ];

        $api->call()->emailTemplates()->patch('reset_email', $patch_data);

        $this->assertEquals('PATCH', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates/reset_email', $api->getHistoryUrl());

        $this->assertEquals($patch_data, $api->getHistoryBody());
    }

    public function testCreate(): void
    {
        $api = new MockManagementApi([new Response(200, self::$headers)]);

        $api->call()->emailTemplates()->create(
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

        $this->assertEquals('POST', $api->getHistoryMethod());
        $this->assertEquals('https://api.test.local/api/v2/email-templates', $api->getHistoryUrl());

        $body = $api->getHistoryBody();
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
