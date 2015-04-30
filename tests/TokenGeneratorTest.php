<?php namespace Auth0\Tests;

use Auth0\SDK\API\Client;
use Auth0\SDK\API\Header\Authorization\AuthorizationBearer;
use Auth0\SDK\API\TokenGenerator;

class TokenGeneratorTest extends \PHPUnit_Framework_TestCase {

    public function getToken() {
        
        $generator = new TokenGenerator([ 'client_id' => '', 'client_secret' => '']);
        
        return $generator->generate([
            'users' => [
                'actions' => ['read']
            ]
        ]);
    }

    public function testList() {
        $auth0 = new Client([
                'domain' => 'https://login.auth0.com',
                'basePath' => '/api/v2',
        ]);

        $response = $auth0->get()
            ->users()
            ->withHeader(new AuthorizationBearer($this->getToken()))
            ->withParam('per_page',1)
            ->call();

    }

}