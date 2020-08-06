<?php
namespace Auth0\Tests\unit\API\Helpers;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\Tests\API\ApiTests;
use Auth0\Tests\unit\API\Management\MockManagementApi;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;

/**
 * Class RequestBuilderTest
 * Tests the Auth0\SDK\API\Helpers\RequestBuilder class.
 *
 * @package Auth0\Tests\unit\API\Helpers
 */
class RequestBuilderTest extends ApiTests
{
    private static function getUrlBuilder($basePath = null)
    {
        return new RequestBuilder(
            [
                'domain' => 'api.local.test',
                'method' => 'get',
                'basePath' => $basePath,
            ]
        );
    }

    public function testUrl()
    {
        $builder = self::getUrlBuilder('/api');

        $this->assertEquals('', $builder->getUrl());

        $builder->addPath('path1');

        $this->assertEquals('path1', $builder->getUrl());

        $builder->addPath('path2', 3);

        $this->assertEquals('path1/path2/3', $builder->getUrl());
    }

    public function testThatASingleUrlParamIsAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', 'value1');

        $this->assertEquals('?param1=value1', $builder->getParams());
    }

    public function testThatEmptyStringParamsAreNotAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', '');

        $this->assertEmpty($builder->getParams());
    }

    public function testThatNullParamsAreNotAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', null);

        $this->assertEmpty($builder->getParams());
    }

    public function testThatTrueParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', true);

        $this->assertEquals('?param1=true', $builder->getParams());
    }

    public function testThatFalseParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', false);

        $this->assertEquals('?param1=false', $builder->getParams());
    }

    public function testThatBooleanFormParamsAreAdded()
    {
        $history = [];
        $mock    = new MockHandler( [ new Response( 200 ), new Response( 200 ) ] );
        $handler = HandlerStack::create($mock);
        $handler->push( Middleware::history($history) );

        $builder = new RequestBuilder( [
            'domain' => 'api.test.local',
            'method' => 'post',
            'returnType' => 'object',
            'guzzleOptions' => [
                'handler' => $handler
            ]
        ] );

        $builder->addFormParam( 'test', true );
        $builder->call();

        $this->assertEquals( 'test=true', $history[0]['request']->getBody() );

        $builder->addFormParam( 'test', false );
        $builder->call();

        $this->assertEquals( 'test=false', $history[1]['request']->getBody() );
    }

    public function testThatZeroParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', 0);

        $this->assertEquals('?param1=0', $builder->getParams());
    }

    public function testThatMultipleUrlParamsAreAdded()
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param2', null);
        $builder->withParam('param3', 'value3');

        $this->assertEquals('?param1=value1&param3=value3', $builder->getParams());
    }

    public function testThatASingleUrlParamValueIsReplaced()
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param1', 'value3');

        $this->assertEquals('?param1=value3', $builder->getParams());
    }

    public function testParams()
    {
        $builder = self::getUrlBuilder('/api');

        // Adding a parameter dictionary should be reflected in the RequestBuilder object.
        $builder->withDictParams([ 'param4' => 'value4', 'param2' => 'value5']);
        $this->assertEquals('?param4=value4&param2=value5', $builder->getParams());
    }

    public function testGetGuzzleOptions()
    {
        $options = self::getUrlBuilder()->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('api.local.test', $options['base_uri']);
    }

    public function testgGetGuzzleOptionsWithBasePath()
    {
        $options = self::getUrlBuilder('/api')->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('api.local.test/api', $options['base_uri']);
    }

    public function testReturnType()
    {
        $response = [ new Response( 200, [ 'Content-Type' => 'application/json' ], '{"key":"__test_value__"}' ) ];

        // Test default return type matches "body".
        $api             = new MockManagementApi( $response, [ 'return_type' => null ] );
        $results_default = $api->call()->tenants()->get();
        $this->assertTrue( is_array( $results_default ) );
        $this->assertArrayHasKey( 'key', $results_default );
        $this->assertEquals( '__test_value__', $results_default['key'] );

        // Test that "body" return type gives us the same result.
        $api          = new MockManagementApi( $response, [ 'return_type' => 'body' ] );
        $results_body = $api->call()->tenants()->get();
        $this->assertEquals( $results_default, $results_body );

        // Test that "headers" return type contains expected keys.
        $api             = new MockManagementApi( $response, [ 'return_type' => 'headers' ] );
        $results_headers = $api->call()->tenants()->get();
        $this->assertArrayHasKey( 'Content-Type', $results_headers );
        $this->assertEquals( 'application/json', $results_headers['Content-Type'][0] );

        // Test that "object" return type returns the correct object type.
        $api            = new MockManagementApi( $response, [ 'return_type' => 'object' ] );
        $results_object = $api->call()->tenants()->get();
        $this->assertInstanceOf( 'GuzzleHttp\Psr7\Response', $results_object );
    }
}
