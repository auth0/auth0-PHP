<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0Api;

class ConnectionsTest extends BasicCrudTest {

    protected function getApiClient() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'connections' => [
                'actions' => ['create', 'read', 'delete', 'update']
            ]
        ]);

        $api = new Auth0Api($token, $env['DOMAIN']);

        return $api->connections;
    }

    protected function getCreateBody() {
        $connection_name = 'test-create-client' . rand();

        echo "\n-- Using connection name $connection_name \n";

        return ['name' => $connection_name, 'strategy' => 'auth0', 'options' => ['requires_username' => false]];
    }
    protected function getUpdateBody() {
        return ['options' => ['requires_username' => true]];
    }
    protected function afterCreate($entity) {
        $this->assertNotTrue($entity['options']['requires_username']);
    }
    protected function afterUpdate($entity) {
        $this->assertTrue($entity['options']['requires_username']);
    }
}