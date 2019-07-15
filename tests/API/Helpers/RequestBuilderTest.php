<?php
namespace Auth0\Tests\API;

use Auth0\SDK\API\Helpers\RequestBuilder;
use Auth0\SDK\API\Management;
use Auth0\SDK\Exception\CoreException;

/**
 * Class RequestBuilderTest
 * Tests the Auth0\SDK\API\Helpers\RequestBuilder class.
 *
 * @package Auth0\Tests\API
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

        $builder->path1();

        $this->assertEquals('path1', $builder->getUrl());

        $builder->path2(3);

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

        // Adding a parameter array should be reflected in the RequestBuilder object.
        $builder->withParams(
            [
                ['key' => 'param1','value' => 'value4'],
                ['key' => 'param3','value' => 'value3'],
            ]
        );
        $this->assertEquals('?param1=value4&param3=value3', $builder->getParams());

        // Adding a parameter dictionary should be reflected in the RequestBuilder object.
        $builder->withDictParams([ 'param4' => 'value4', 'param2' => 'value5']);
        $this->assertEquals('?param1=value4&param3=value3&param4=value4&param2=value5', $builder->getParams());
    }

    public function testFullUrl()
    {
        $builder = self::getUrlBuilder('/api');

        $builder->path(2)
            ->subpath()
            ->withParams(
                [
                    ['key' => 'param1', 'value' => 'value1'],
                    ['key' => 'param2', 'value' => 'value2'],
                ]
            );

        $this->assertEquals('path/2/subpath?param1=value1&param2=value2', $builder->getUrl());
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

    /**
     * Test that the return type is set properly and returns the correct result.
     *
     * @throws \Auth0\SDK\Exception\ApiException Should not be thrown in this test.
     */
    public function testReturnType()
    {
        $env   = self::getEnv();
        $token = self::getToken($env);

        // Test default return type matches "body".
        $api             = new Management($token, $env['DOMAIN'], []);
        $results_default = $api->tenants->get();
        $this->assertTrue( is_array( $results_default ) );

        $api          = new Management($token, $env['DOMAIN'], [], 'body');
        $results_body = $api->tenants->get();
        $this->assertEquals( $results_default, $results_body );

        // Test that "headers" return type contains expected keys.
        $api             = new Management($token, $env['DOMAIN'], [], 'headers');
        $results_headers = $api->tenants->get();
        $this->assertArrayHasKey( 'x-ratelimit-limit', $results_headers );
        $this->assertArrayHasKey( 'x-ratelimit-remaining', $results_headers );
        $this->assertArrayHasKey( 'x-ratelimit-reset', $results_headers );

        // Test that "object" return type returns the correct object type.
        $api            = new Management($token, $env['DOMAIN'], [], 'object');
        $results_object = $api->tenants->get();
        $this->assertInstanceOf( 'GuzzleHttp\Psr7\Response', $results_object );

        // Test that an invalid return type throws an error.
        $caught_return_type_error = false;
        try {
            $api = new Management($token, $env['DOMAIN'], [], '__invalid_return_type__');
            $api->tenants->get();
        } catch (CoreException $e) {
            $caught_return_type_error = $this->errorHasString( $e, 'Invalid returnType' );
        }

        $this->assertTrue( $caught_return_type_error );
    }
}
