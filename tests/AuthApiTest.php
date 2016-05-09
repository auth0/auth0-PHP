<?php
namespace Auth0\Tests;

use Auth0\SDK\Auth0AuthApi;

class AuthApiTest extends ApiTests {

    public function testAuthorize() {

        $domain = 'dummy.auth0.com';
        $client_id = '123456';

        $api = new Auth0AuthApi($domain, $client_id);

        $authorize_url = $api->get_authorize_link('code', 'http://lala.com');

        $this->assertEquals("https://dummy.auth0.com/authorize?response_type=code&redirect_uri=http://lala.com&client_id=123456", $authorize_url);

        $authorize_url2 = $api->get_authorize_link('token', 'http://lala.com', 'facebook', 'dastate');

        $this->assertEquals("https://dummy.auth0.com/authorize?response_type=token&redirect_uri=http://lala.com&client_id=123456&connection=facebook&state=dastate", $authorize_url2);
    }
}