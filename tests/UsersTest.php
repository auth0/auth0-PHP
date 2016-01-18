<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0Api;

class UsersTest extends BasicCrudTest {

    protected $email; 

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

        $api = new Auth0Api($token, $env['DOMAIN']);

        return $api->users;
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