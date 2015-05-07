<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 10:13 AM
 */

namespace Auth0\Tests;


use Auth0\SDK\API\Client;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;

class ConnectionsTest extends \PHPUnit_Framework_TestCase {

    protected $token = '';

    public function testGetAll() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->connections()
            ->withHeader(new AuthorizationBearer($this->token))
            ->call();

        $this->assertTrue(is_array($response));
        $this->assertTrue(count($response)>0);

    }
    public function testGetAllWithStrategy() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->connections()
            ->withHeader(new AuthorizationBearer($this->token))
            ->withParam('strategy', 'facebook')
            ->call();

        $this->assertTrue(is_array($response));
        $this->assertCount(1,$response);
        $this->assertObjectHasAttribute('name',$response[0]);
        $this->assertObjectHasAttribute('strategy',$response[0]);
        $this->assertEquals('facebook',$response[0]->name);

    }
    public function testGetAllWithStrategyAndFields() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->connections()
            ->withHeader(new AuthorizationBearer($this->token))
            ->withParam('strategy', 'facebook')
            ->withParam('fields', 'name,id')
            ->withParam('include_fields', true)
            ->call();

        $this->assertTrue(is_array($response));
        $this->assertCount(1,$response);
        $this->assertObjectHasAttribute('name',$response[0]);
        $this->assertObjectHasAttribute('id',$response[0]);
        $this->assertObjectNotHasAttribute('strategy',$response[0]);
        $this->assertEquals('facebook',$response[0]->name);

    }
    public function testGetAllWithStrategyAndWithoutFields() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->connections()
            ->withHeader(new AuthorizationBearer($this->token))
            ->withParam('strategy', 'facebook')
            ->withParam('fields', 'name,id')
            ->withParam('include_fields', false)
            ->call();

        $this->assertTrue(is_array($response));
        $this->assertCount(1,$response);
        $this->assertObjectNotHasAttribute('name',$response[0]);
        $this->assertObjectNotHasAttribute('id',$response[0]);
        $this->assertObjectHasAttribute('strategy',$response[0]);
        $this->assertEquals('facebook',$response[0]->strategy);

    }


}