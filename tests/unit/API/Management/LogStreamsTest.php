<?php


namespace Auth0\Tests\unit\API\Management;


use Auth0\SDK\API\Helpers\InformationHeaders;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use GuzzleHttp\Psr7\Response;
use Auth0\Tests\API\ApiTests;

class LogStreamsTest extends ApiTests
{
    /**
     * Expected telemetry value.
     *
     * @var string
     */
    protected static $expectedTelemetry;

    /**
     * Default request headers.
     *
     * @var array
     */
    protected static $headers = [ 'content-type' => 'json' ];

    /**
     * Runs before test suite starts.
     */
    public static function setUpBeforeClass()
    {
        $infoHeadersData = new InformationHeaders;
        $infoHeadersData->setCorePackage();
        self::$expectedTelemetry = $infoHeadersData->build();
    }

    public function testThatGetAllRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->logStreams()->getAll();

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/log-streams', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetLogStreamRequestIsFormedProperly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->logStreams()->get('123');

        $this->assertEquals( 'GET', $api->getHistoryMethod() );
        $this->assertStringStartsWith( 'https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatGetLogStreamWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->get( '' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Empty or invalid log_stream_id', $exception_message );
    }

    public function testThatCreateLogStreamRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->logStreams()->create([
            'name' => 'Test Stream',
            'type' => 'http',
            'sink' => [
                'httpEndpoint' => 'https://me.org',
                'httpContentFormat' => 'JSONLINES',
                'httpContentType' => 'application/json',
                'httpAuthorization' => 'abc123'
            ]
        ]);

        $this->assertEquals( 'POST', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/log-streams', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( 'Test Stream', $body['name'] );
        $this->assertArrayHasKey( 'type', $body );
        $this->assertEquals( 'http', $body['type'] );
        $this->assertArrayHasKey( 'sink', $body );
        $this->assertEquals('https://me.org', $body['sink']['httpEndpoint']);
        $this->assertEquals('JSONLINES', $body['sink']['httpContentFormat']);
        $this->assertEquals('application/json', $body['sink']['httpContentType']);
        $this->assertEquals('abc123', $body['sink']['httpAuthorization']);
    }

    public function testThatCreateLogStreamRequestWithEmptyDataThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->create( [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "data" parameter', $exception_message );
    }

    public function testThatCreateLogStreamRequestWithEmptyTypeThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->create( [
                'name' => 'test stream',
                'sink' => [
                    'httpEndpoint' => 'https://me.org',
                    'httpContentFormat' => 'JSONLINES',
                    'httpContentType' => 'application/json',
                    'httpAuthorization' => 'abc123'
                ]
            ] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "type" field', $exception_message );
    }

    public function testThatCreateLogStreamRequestWithMissingSinkThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->create( [
                'name' => 'test stream',
                'type' => 'http'
            ] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "sink" field', $exception_message );
    }

    public function testThatCreateLogStreamRequestWithEmptySinkThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->create( [
                'name' => 'test stream',
                'type' => 'http',
                'sink' => [ ]
            ] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "sink" field', $exception_message );
    }

    public function testThatUpdateLogStreamRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->logStreams()->update('123', [
            'name' => 'Test Name'
        ]);

        $this->assertEquals( 'PATCH', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );

        $body = $api->getHistoryBody();
        $this->assertArrayHasKey( 'name', $body );
        $this->assertEquals( 'Test Name', $body['name'] );
    }

    public function testThatUpdateLogStreamRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
            $api->call()->logStreams()->update('', [] );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "log_stream_id" field', $exception_message );
    }

    public function testThatDeleteLogStreamRequestIsFormedCorrectly()
    {
        $api = new MockManagementApi( [ new Response( 200, self::$headers ) ] );

        $api->call()->logStreams()->delete( '123' );

        $this->assertEquals( 'DELETE', $api->getHistoryMethod() );
        $this->assertEquals( 'https://api.test.local/api/v2/log-streams/123', $api->getHistoryUrl() );

        $headers = $api->getHistoryHeaders();
        $this->assertEquals( 'Bearer __api_token__', $headers['Authorization'][0] );
        $this->assertEquals( 'application/json', $headers['Content-Type'][0] );
        $this->assertEquals( self::$expectedTelemetry, $headers['Auth0-Client'][0] );
    }

    public function testThatDeleteLogStreamRequestWithEmptyIdThrowsException()
    {
        $api = new MockManagementApi();

        try {
        $api->call()->logStreams()->delete('' );
            $exception_message = '';
        } catch (EmptyOrInvalidParameterException $e) {
            $exception_message = $e->getMessage();
        }

        $this->assertContains( 'Missing required "log_stream_id" field', $exception_message );
    }
}