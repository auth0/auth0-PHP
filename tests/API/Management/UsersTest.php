<?php
namespace Auth0\Tests\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\API\BasicCrudTest;

class UsersTest extends BasicCrudTest {

    protected $email;
    protected $findCreatedItem = false;

    protected function getId($entity) {
        return $entity['user_id'];
    }

    protected function getApiClient($scopes = null) {

        if ($scopes === null) {
            $scopes = ['create', 'read', 'delete', 'update'];
        }

        $env = $this->getEnv();
        $token = $this->getToken($env, [
            'users' => [
                'actions' => $scopes
            ]
        ]);

        $this->domain = $env['DOMAIN'];

        $api = new Management($token, $this->domain);

        return $api->users;
    }

    protected function getAll($client, $entity) { echo "user_id:'{$entity['user_id']}'";
        return $client->getAll([
            "q" => "user_id:'{$entity['user_id']}'",
            "search_engine"=>"v2"
        ]);
    }

    protected function getCreateBody() {
        $this->email = 'test-create-user' . rand();
        echo "\n-- Using user email {$this->email} \n";

        return [
            'connection' => 'Username-Password-Authentication',
            'email' => $this->email . '@test.com',
            'password' => '123456',
            'email_verified' => true
        ];
    }

    protected function getUpdateBody() {
        return ['email' => $this->email . 'changed@test.com'];
    }
    protected function afterCreate($entity) {
        $this->assertEquals($this->email . '@test.com', $entity['email']);
    }
    protected function afterUpdate($entity) {
        $this->assertEquals($this->email . 'changed@test.com', $entity['email']);
    }
}