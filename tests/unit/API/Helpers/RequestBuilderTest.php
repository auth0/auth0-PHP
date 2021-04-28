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
 */
class RequestBuilderTest extends ApiTests
{
    /**
     * Retrieve a mock RequestBuilder instance.
     *
     * @param mixed|null $basePath basePath to pass to RequestBuilder.
     *
     * @return RequestBuilder
     */
    private static function getUrlBuilder($basePath = null)
    {
        return new RequestBuilder(
            [
                'domain'   => 'api.local.test',
                'method'   => 'get',
                'basePath' => $basePath,
            ]
        );
    }

    /**
     * Test addPath().
     *
     * @return void
     */
    public function testUrl()
    {
        $builder = self::getUrlBuilder('/api');

        $this->assertEquals('', $builder->getUrl());

        $builder->addPath('path1');

        $this->assertEquals('path1', $builder->getUrl());

        $builder->addPath('path2', 3);

        $this->assertEquals('path1/path2/3', $builder->getUrl());
    }

    /**
     * Test that a single url param si added.
     *
     * @return void
     */
    public function testThatASingleUrlParamIsAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', 'value1');

        $this->assertEquals('?param1=value1', $builder->getParams());
    }

    /**
     * Test that empty string params are not added.
     *
     * @return void
     */
    public function testThatEmptyStringParamsAreNotAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', '');

        $this->assertEmpty($builder->getParams());
    }

    /**
     * Test that null params are not added.
     *
     * @return void
     */
    public function testThatNullParamsAreNotAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', null);

        $this->assertEmpty($builder->getParams());
    }

    /**
     * Test that true params are added.
     *
     * @return void
     */
    public function testThatTrueParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', true);

        $this->assertEquals('?param1=true', $builder->getParams());
    }

    /**
     * Test that false params are added.
     *
     * @return void
     */
    public function testThatFalseParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', false);

        $this->assertEquals('?param1=false', $builder->getParams());
    }

    /**
     * Test that boolean form params are added.
     *
     * @return void
     */
    public function testThatBooleanFormParamsAreAdded()
    {
        $history = [];
        $mock    = new MockHandler([new Response(200), new Response(200)]);
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($history));

        $builder = new RequestBuilder(
            [
                'domain'        => 'api.test.local',
                'method'        => 'post',
                'guzzleOptions' => ['handler' => $handler],
            ]
        );

        $builder->addFormParam('test', true);
        $builder->call();

        $this->assertEquals('test=true', $history[0]['request']->getBody());

        $builder->addFormParam('test', false);
        $builder->call();

        $this->assertEquals('test=false', $history[1]['request']->getBody());
    }

    /**
     * Test that 0 int params are added.
     *
     * @return void
     */
    public function testThatZeroParamsAreAdded()
    {
        $builder = self::getUrlBuilder()->withParam('param1', 0);

        $this->assertEquals('?param1=0', $builder->getParams());
    }

    /**
     * Test that multiple url params are added.
     *
     * @return void
     */
    public function testThatMultipleUrlParamsAreAdded()
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param2', null);
        $builder->withParam('param3', 'value3');

        $this->assertEquals('?param1=value1&param3=value3', $builder->getParams());
    }

    /**
     * Test that single url param values are replaced..
     *
     * @return void
     */
    public function testThatASingleUrlParamValueIsReplaced()
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param1', 'value3');

        $this->assertEquals('?param1=value3', $builder->getParams());
    }

    /**
     * Test that withParams() generates a query string correctly.
     *
     * @return void
     */
    public function testParams()
    {
        $builder = self::getUrlBuilder('/api');

        // Adding a parameter dictionary should be reflected in the RequestBuilder object.
        $builder->withParams(['param4' => 'value4', 'param2' => 'value5']);
        $this->assertEquals('?param4=value4&param2=value5', $builder->getParams());
    }

    /**
     * Test that getGuzzleOptions() works.
     *
     * @return void
     */
    public function testGetGuzzleOptions()
    {
        $options = self::getUrlBuilder()->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('api.local.test', $options['base_uri']);
    }

    /**
     * Test that getGuzzleOptions w/ a base path works.
     *
     * @return void
     */
    public function testGetGuzzleOptionsWithBasePath()
    {
        $options = self::getUrlBuilder('/api')->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('api.local.test/api', $options['base_uri']);
    }

    /**
     * Test that return types are used correctly.
     *
     * @return void
     */
    public function testReturnType()
    {
        $response = [new Response(200, ['Content-Type' => 'application/json'], '{"key":"__test_value__"}')];

        // Test default return type matches "body".
        $api = new MockManagementApi($response, ['return_type' => null]);
        $results_default = $api->call()->tenants()->get();
        $this->assertTrue(is_array($results_default));
        $this->assertArrayHasKey('key', $results_default);
        $this->assertEquals('__test_value__', $results_default['key']);

        // Test that "body" return type gives us the same result.
        $api          = new MockManagementApi($response, ['return_type' => 'body']);
        $results_body = $api->call()->tenants()->get();
        $this->assertEquals($results_default, $results_body);

        // Test that "headers" return type contains expected keys.
        $api = new MockManagementApi($response, ['return_type' => 'headers']);
        $results_headers = $api->call()->tenants()->get();
        $this->assertArrayHasKey('Content-Type', $results_headers);
        $this->assertEquals('application/json', $results_headers['Content-Type'][0]);
    }
}
