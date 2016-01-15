<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0Api;

class ClientsTest extends ApiTests {

    public function testGetAll() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'clients' => [
                'actions' => ['read']
            ]
        ]);

        $api = new Auth0Api($token, $env['DOMAIN']);

        $api->clients->getAll();
    }

    public function testCreateGetDelete() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'clients' => [
                'actions' => ['create', 'read', 'delete', 'update']
            ]
        ]);

        $client_name = 'test-create-client' . rand();

        $api = new Auth0Api($token, $env['DOMAIN']);

        $client = $api->clients->create(['name' => $client_name, 'sso' => false]);

        $client2 = $api->clients->get($client['client_id']);

        $this->assertNotTrue($client2['sso']);

        $client3 = $api->clients->update($client['client_id'], ['sso' => true]);

        $this->assertTrue($client3['sso']);

        $api->clients->delete($client['client_id']);
    }
}