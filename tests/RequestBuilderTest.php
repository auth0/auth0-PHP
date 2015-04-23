<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/22/15
 * Time: 3:45 PM
 */

namespace Auth0\Tests;


use Auth0\SDK\API\RequestBuilder;

class RequestBuilderTest  extends \PHPUnit_Framework_TestCase{

    public function testUrl() {

        $builder = new RequestBuilder([
            'domain' => 'www.domain.com',
            'method' => 'get',
        ]);

        $this->assertEquals('www.domain.com/', $builder->getUrl());

        $builder->path1();

        $this->assertEquals('www.domain.com/path1', $builder->getUrl());

        $builder->path2(3);

        $this->assertEquals('www.domain.com/path1/path2/3', $builder->getUrl());

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

        $this->assertEquals('www.domain.com/path/2/subpath?param1=value1&param2=value2', $builder->getUrl());
    }

}