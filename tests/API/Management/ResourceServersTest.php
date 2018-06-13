<?php

namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\ApiTests;
use GuzzleHttp\Exception\ClientException;

class ResourceServersTest extends ApiTests
{
  
    protected $domain;
    protected $clientId;
    protected $token;
    protected $api;
  
    public static $serverName;
    public static $serverIdentifier;
    public static $createdServerId = '';
  
  /**
   * Test fixture for class
   */
    public static function setUpBeforeClass()
    {
        self::$serverName = 'TEST_PHP_SDK_' . uniqid();
        self::$serverIdentifier = 'TEST_PHP_SDK_' . uniqid();
    }
  
  /**
   * Test fixture for each method
   */
    protected function setUp()
    {
        $env = $this->getEnv();
    
        $this->domain = $env['DOMAIN'];
        $this->clientId = $env['APP_CLIENT_ID'];
        $this->token = $token = $this->getToken($env, [
        'resource_servers' => [
        'actions' => ['create', 'read', 'delete', 'update']
        ]
        ]);
    
        $this->api = new Management($this->token, $this->domain);
    
        $this->assertNotEmpty($this->token);
    }
  
  /**
   * Test creating a resource server
   */
    public function testCreate()
    {
        $response = $this->api->resource_servers->create($this->clientId, [
        'name' => self::$serverName,
        'identifier' => self::$serverIdentifier,
        ]);
  
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response['id']);
        $this->assertEquals($response['name'], self::$serverName);
        $this->assertEquals($response['identifier'], self::$serverIdentifier);
  
        self::$createdServerId = $response['id'];
    }
  
  /**
   * Test getting the resource server created above
   */
    public function testGet()
    {
        $response = $this->api->resource_servers->get(self::$createdServerId);
  
        $this->assertEquals($response['id'], self::$createdServerId);
        $this->assertEquals($response['name'], self::$serverName);
        $this->assertEquals($response['identifier'], self::$serverIdentifier);
    }
  
  /**
   * Test getting all resource servers and finding the one we added
   */
    public function testGetAll()
    {
        $response = $this->api->resource_servers->getAll();
  
      // Make sure the one we added was found
        $found_added = false;
        foreach ($response as $server) {
            if ($server['id'] === self::$createdServerId) {
                $found_added = true;
                break;
            }
        }
    
        $this->assertGreaterThanOrEqual(2, count($response));
        $this->assertTrue($found_added);
    }
  
    public function testUpdate()
    {
    
      // Swap name and identifier
        $update_data = [ 'signing_alg' => 'HS256' ];
        $response = $this->api->resource_servers->update(self::$createdServerId, $update_data);
    
      // Make sure everything we tried to update was updated
        $matched = true;
        foreach ($update_data as $key => $val) {
            if ($response[ $key ] !== $val) {
                $matched = false;
                break;
            }
        }
    
        $this->assertTrue($matched);
    }
  
  /**
   * Test deleting the resource server created above
   */
    public function testDelete()
    {
        $response = $this->api->resource_servers->delete(self::$createdServerId);
  
      // Look for the resource server we just deleted
        $get_server_throws_error = false;
        try {
            $this->api->resource_servers->get(self::$createdServerId);
        } catch (ClientException $e) {
            $get_server_throws_error = 404 === $e->getCode();
        }
  
        $this->assertNull($response);
        $this->assertTrue($get_server_throws_error);
    }
}
