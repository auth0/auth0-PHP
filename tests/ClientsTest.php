<?php namespace Auth0\Tests;

use Auth0\SDK\API\Client;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\Header\ContentType;

class ClientsTest extends \PHPUnit_Framework_TestCase {

    protected $token = '';
    protected $id = null;

    public function testGetAll() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->clients()
            ->withHeader(new AuthorizationBearer($this->token))
            ->call();

        $this->assertTrue(is_array($response));
        $this->assertTrue(count($response)>0);
    }

    public function testCreateOne() {

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $values = [
            'name' => 'TestApp',
        ];

        $response = $auth0->post()
            ->clients()
            ->withHeader(new AuthorizationBearer($this->token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($values))
            ->call();

        $this->id = $response->client_id;

        $this->assertObjectHasAttribute('client_id', $response);
        $this->assertObjectHasAttribute('client_secret', $response);
        $this->assertObjectHasAttribute('signing_keys', $response);

        foreach ($values as $key => $value) {
            $this->assertObjectHasAttribute($key, $response);
            $this->assertEquals($value, $response->$key);
        }
    }

    /**
     * @depends testCreateOne
     */
    public function testGetOne() {

        $id = $this->getIdByName(['TestApp', 'THIS WAS UPDATED']);

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->clients($id)
            ->withHeader(new AuthorizationBearer($this->token))
            ->call();

        $this->assertObjectHasAttribute('client_id', $response);
        $this->assertObjectHasAttribute('name', $response);
        $this->assertObjectHasAttribute('tenant', $response);
        $this->assertEquals($id, $response->client_id);
    }

    /**
     * @depends testGetOne
     */
    public function testUpdateOne() {

        $id = $this->getIdByName(['TestApp', 'THIS WAS UPDATED']);

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $values = [
            'name' => 'THIS WAS UPDATED'
        ];

        $response = $auth0->patch()
            ->clients($id)
            ->withHeader(new AuthorizationBearer($this->token))
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode($values))
            ->call();

        $this->assertObjectHasAttribute('client_id', $response);
        $this->assertEquals($id, $response->client_id);

        foreach ($values as $key => $value) {
            $this->assertObjectHasAttribute($key, $response);
            $this->assertEquals($value, $response->$key);
        }
    }

    /**
     * @depends testUpdateOne
     */
    public function testDeleteOne() {

        $id = $this->getIdByName(['TestApp', 'THIS WAS UPDATED', 'My application', 'asdf']);

        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->delete()
            ->clients($id)
            ->withHeader(new AuthorizationBearer($this->token))
            ->call();

    }

    protected function getIdByName($names) {
        $auth0 = new Client([
            'domain' => 'https://login.auth0.com',
            'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->clients()
            ->withHeader(new AuthorizationBearer($this->token))
            ->call();

        foreach ($response as $client) {
            if (in_array( $client->name , $names )) return $client->client_id;
        }
        die('APP DOES NOT EXISTS');
    }

}
