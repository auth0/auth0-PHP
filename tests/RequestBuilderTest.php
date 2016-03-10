<?php
namespace Auth0\Tests;

use Auth0\SDK\API\Helpers\RequestBuilder;

class RequestBuilderTest  extends \PHPUnit_Framework_TestCase{

    public function testUrl() {

        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'basePath' => '/api',
            'method' => 'get',
        ]);

        $this->assertEquals('', $builder->getUrl());

        $builder->path1();

        $this->assertEquals('path1', $builder->getUrl());

        $builder->path2(3);

        $this->assertEquals('path1/path2/3', $builder->getUrl());

    }

    public function testParams() {

        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'method' => 'get',
        ]);

        $builder->withParam('param1', 'value1');

        $this->assertEquals('?param1=value1', $builder->getParams());

        $builder->withParam('param2', 'value2');

        $this->assertEquals('?param1=value1&param2=value2', $builder->getParams());

        $builder->withParams([
            ['key' => 'param3','value'=>'value3'],
            ['key' => 'param1','value'=>'value4'],
        ]);

        $this->assertEquals('?param1=value4&param2=value2&param3=value3', $builder->getParams());
    }

    public function testFullUrl() {
        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'method' => 'get',
        ]);

        $builder->path(2)
                ->subpath()
                ->withParams([
                    ['key' => 'param1', 'value' => 'value1'],
                    ['key' => 'param2', 'value' => 'value2'],
                ]);

        $this->assertEquals('path/2/subpath?param1=value1&param2=value2', $builder->getUrl());
    }

    public function testGetGuzzleOptions() {
        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'method' => 'get',
        ]);

        $options = $builder->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('www.domain.com', $options['base_uri']);
    }

    public function testgGetGuzzleOptionsWithBasePath() {
        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'basePath' => '/api',
            'method' => 'get',
        ]);

        $options = $builder->getGuzzleOptions();

        $this->assertArrayHasKey('base_uri', $options);
        $this->assertEquals('www.domain.com/api', $options['base_uri']);
    }

}