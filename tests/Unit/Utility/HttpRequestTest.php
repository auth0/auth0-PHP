<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpRequestTest
 * Tests the Auth0\SDK\Utility\HttpRequest class.
 */
class HttpRequestTest extends TestCase
{
    /**
     * Retrieve a mock RequestBuilder instance.
     *
     * @param mixed|null $basePath basePath to pass to RequestBuilder.
     */
    private static function getUrlBuilder(
        string $basePath = '/',
        string $method = 'get'
    ): HttpRequest {
        $config = new SdkConfiguration([
            'domain' => 'api.local.test',
            'cookieSecret' => uniqid(),
            'clientId' => uniqid(),
            'redirectUri' => uniqid(),
        ]);

        return new HttpRequest($config, HttpClient::CONTEXT_GENERIC_CLIENT, $method, $basePath);
    }

    /**
     * Test addPath().
     */
    public function testUrl(): void
    {
        $builder = self::getUrlBuilder('/api');

        $this->assertEquals('', $builder->getUrl());

        $builder->addPath('path1');

        $this->assertEquals('path1', $builder->getUrl());

        $builder->addPath('path2', '3');

        $this->assertEquals('path1/path2/3', $builder->getUrl());
    }

    /**
     * Test that a single url param si added.
     */
    public function testThatASingleUrlParamIsAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', 'value1');

        $this->assertEquals('?param1=value1', $builder->getParams());
    }

    /**
     * Test that empty string params are not added.
     */
    public function testThatEmptyStringParamsAreNotAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', '');

        $this->assertEmpty($builder->getParams());
    }

    /**
     * Test that null params are not added.
     */
    public function testThatNullParamsAreNotAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', null);

        $this->assertEmpty($builder->getParams());
    }

    /**
     * Test that true params are added.
     */
    public function testThatTrueParamsAreAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', true);

        $this->assertEquals('?param1=true', $builder->getParams());
    }

    /**
     * Test that false params are added.
     */
    public function testThatFalseParamsAreAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', false);

        $this->assertEquals('?param1=false', $builder->getParams());
    }

    /**
     * Test that boolean form params are added.
     */
    public function testThatBooleanFormParamsAreAdded(): void
    {
        $httpRequest = self::getUrlBuilder('/', 'post')->withFormParam('test', 'true');
        $httpRequest->call();

        $this->assertEquals('test=true', $httpRequest->getLastRequest()->getBody()->__toString());

        $httpRequest = self::getUrlBuilder('/', 'post')->withFormParam('test', 'false');
        $httpRequest->call();

        $this->assertEquals('test=false', $httpRequest->getLastRequest()->getBody()->__toString());
    }

    /**
     * Test that 0 int params are added.
     */
    public function testThatZeroParamsAreAdded(): void
    {
        $builder = self::getUrlBuilder()->withParam('param1', 0);

        $this->assertEquals('?param1=0', $builder->getParams());
    }

    /**
     * Test that multiple url params are added.
     */
    public function testThatMultipleUrlParamsAreAdded(): void
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param2', null);
        $builder->withParam('param3', 'value3');

        $this->assertEquals('?param1=value1&param3=value3', $builder->getParams());
    }

    /**
     * Test that single url param values are replaced..
     */
    public function testThatASingleUrlParamValueIsReplaced(): void
    {
        $builder = self::getUrlBuilder();
        $builder->withParam('param1', 'value1');
        $builder->withParam('param1', 'value3');

        $this->assertEquals('?param1=value3', $builder->getParams());
    }

    /**
     * Test that withParams() generates a query string correctly.
     */
    public function testParams(): void
    {
        $builder = self::getUrlBuilder('/api');

        // Adding a parameter dictionary should be reflected in the RequestBuilder object.
        $builder->withParams(['param4' => 'value4', 'param2' => 'value5']);
        $this->assertEquals('?param4=value4&param2=value5', $builder->getParams());
    }
}
