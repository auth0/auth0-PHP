<?php namespace Auth0\Tests;

use Auth0\SDK\API\Helpers\TokenGenerator;
use Auth0\SDK\Auth0JWT;

class TokenTest extends \PHPUnit_Framework_TestCase {

    public function testTokenGenerationDecode() {

        $client_id = 'client_id_1';
        $client_secret = 'client_secret_1';
        
        $generator = new TokenGenerator([ 'client_id' => $client_id, 'client_secret' => $client_secret]);
        
        $jwt = $generator->generate([
            'users' => [
                'actions' => ['read']
            ]
        ]);

        $decoded = Auth0JWT::decode($jwt, $client_id, $client_secret);

        $this->assertObjectHasAttribute('aud', $decoded);
        $this->assertEquals($client_id, $decoded->aud);
        $this->assertObjectHasAttribute('scopes', $decoded);
        $this->assertObjectHasAttribute('users', $decoded->scopes);
        $this->assertObjectHasAttribute('actions', $decoded->scopes->users);
        $this->assertArraySubset(['read'], $decoded->scopes->users->actions);
    }

}