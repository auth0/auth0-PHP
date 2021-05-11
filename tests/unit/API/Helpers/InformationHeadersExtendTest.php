<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Helpers;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\Tests\unit\API\Authentication\MockAuthenticationApi;
use Auth0\Tests\unit\API\Management\MockManagementApi;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class InformationHeadersExtendTest.
 */
class InformationHeadersExtendTest extends TestCase
{
    public static function tearDownAfterClass(): void
    {
        $reset_headers = new InformationHeaders();
        $reset_headers->setCorePackage();
        ApiClient::setInfoHeadersData($reset_headers);
        parent::tearDownAfterClass();
    }

    /**
     * Test that extending the headers works for Management API calls.
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function testThatExtendedHeadersAreUsedForManagementApiCalls(): void
    {
        $new_headers = self::setExtendedHeaders('test-extend-sdk-2', '2.3.4');

        $api = new MockManagementApi([new Response(200)]);
        $api->call()->connections()->getAll();
        $headers = $api->getHistoryHeaders();

        $this->assertEquals($new_headers->build(), $headers['Auth0-Client'][0]);
    }

    /**
     * Test that extending the headers works for Management API calls.
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     */
    public function testThatExtendedHeadersAreUsedForAuthenticationApiCalls(): void
    {
        $new_headers = self::setExtendedHeaders('test-extend-sdk-3', '3.4.5');

        $api = new MockAuthenticationApi(
            [
                new Response(200, ['Content-Type' => 'application/json'], '{}'),
            ]
        );

        $api->call()->oauthToken(['grant_type' => uniqid()]);
        $headers = $api->getHistoryHeaders();

        $this->assertEquals($new_headers->build(), $headers['Auth0-Client'][0]);
    }

    /*
     * Test helper methods.
     */

    /**
     * Reset and extend telemetry headers.
     *
     * @param string $name    New SDK name.
     * @param string $version New SDK version.
     */
    public static function setExtendedHeaders(string $name, string $version): InformationHeaders
    {
        $reset_headers = new InformationHeaders();
        $reset_headers->setCorePackage();
        ApiClient::setInfoHeadersData($reset_headers);

        $headers = ApiClient::getInfoHeadersData();
        $new_headers = InformationHeaders::Extend($headers);
        $new_headers->setPackage($name, $version);
        ApiClient::setInfoHeadersData($new_headers);

        return $new_headers;
    }
}
