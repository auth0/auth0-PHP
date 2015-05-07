<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 11:22 AM
 */

namespace Auth0\Tests;


use Auth0\SDK\API\Client;
use Auth0\SDK\Header\ContentType;

class AuthenticationTest extends \PHPUnit_Framework_TestCase {

    public function testRo() {

        $auth0 = new Client([
            'domain' => 'https://wptest.auth0.com',
            'basePath' => '/',
        ]);

        $response = $auth0->get()
            ->oauth()->ro()
            ->withHeader(new ContentType('application/json'))
            ->withBody(json_encode([
                "client_id" => "5tUy41aD5PcReduVKTDdZXfRySdXsQA7",
                "username" => "german.lena+newuser@gmail.com",
                "password" => "123456",
                "connection" => "Username-Password-Authentication",
                "grant_type" => "password",
                "scope" => "openid",
            ]))
            ->call();

        var_dump($response);
    }

}
