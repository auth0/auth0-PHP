<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0Api;

class ConnectionsTest extends ApiTests {

    public function testGetAll() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'connections' => [
                'actions' => ['read']
            ]
        ]);

        $api = new Auth0Api($token, $env['DOMAIN']);

        $api->connections->getAll();
    }

    public function testCreateGetDelete() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'connections' => [
                'actions' => ['create', 'read', 'delete', 'update']
            ]
        ]);

        $api = new Auth0Api($token, $env['DOMAIN']);

        $connection_name = 'test-create-client' . rand();

        echo "-- Using connection name $connection_name \n";

        $connection = $api->connections->create(['name' => $connection_name, 'strategy' => 'auth0', 'options' => ['requires_username' => false]]);

        $conection2 = $api->connections->get($connection['id']);

        $this->assertNotTrue($conection2['options']['requires_username']);

        $connection3 = $api->connections->update($connection['id'], ['options' => ['requires_username' => true]]);

        $this->assertTrue($connection3['options']['requires_username']);

        $api->connections->delete($connection['id']);
    }
}