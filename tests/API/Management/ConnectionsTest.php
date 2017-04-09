<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\BasicCrudTest;

class ConnectionsTest extends BasicCrudTest {

    protected function getApiClient() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'connections' => [
                'actions' => ['create', 'read', 'delete', 'update']
            ]
        ]);

        $this->domain = $env['DOMAIN'];

        $api = new Management($token, $env['DOMAIN']);

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