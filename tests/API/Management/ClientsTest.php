<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\BasicCrudTest;

class ClientsTest extends BasicCrudTest {
    
    protected function getId($entity) {
        return $entity['client_id'];
    }

    protected function getApiClient() {
        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'clients' => [
                'actions' => ['create', 'read', 'delete', 'update']
            ]
        ]);

        $this->domain = $env['DOMAIN'];

        $api = new Management($token, $env['DOMAIN']);

        return $api->clients;
    }

    protected function getCreateBody() {
        $client_name = 'test-create-client' . rand();
        echo "\n-- Using client name $client_name \n";

        return ['name' => $client_name, 'sso' => false];
    }
    protected function getUpdateBody() {
        return ['sso' => true];
    }
    protected function afterCreate($entity) {
        $this->assertNotTrue($entity['sso']);
    }
    protected function afterUpdate($entity) {
        $this->assertTrue($entity['sso']);
    }
}