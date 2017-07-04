<?php

namespace Auth0\Tests;

use Auth0\SDK\Auth0;
use Nyholm\NSA;
use PHPUnit\Framework\TestCase;

class Auth0Test extends TestCase
{
    public function testConstructorDefaults()
    {
        $auth0 = new Auth0([
            'domain' => 'foo',
            'client_id' => 'bar',
            'client_secret' => 'baz',
            'redirect_uri' => 'biz',
            'store' => false,
        ]);

        $this->assertEquals('foo', NSA::getProperty($auth0, 'domain'));
        $this->assertEquals('bar', NSA::getProperty($auth0, 'client_id'));
        $this->assertEquals('baz', NSA::getProperty($auth0, 'client_secret'));
        $this->assertEquals('biz', NSA::getProperty($auth0, 'redirect_uri'));
        $this->assertEquals(null, NSA::getProperty($auth0, 'audience'));
        $this->assertEquals('query', NSA::getProperty($auth0, 'response_mode'));
        $this->assertEquals('code', NSA::getProperty($auth0, 'response_type'));
        $this->assertEquals(null, NSA::getProperty($auth0, 'scope'));
        $this->assertEquals(false, NSA::getProperty($auth0, 'debug_mode'));
        $this->assertEquals(['user'], array_values(NSA::getProperty($auth0, 'persistantMap')));
    }

    public function testConstructor()
    {
        $auth0 = new Auth0([
            'domain' => 'foo',
            'client_id' => 'bar',
            'client_secret' => 'baz',
            'redirect_uri' => 'biz',
            'store' => false,
            'persist_user' => false,
            'persist_access_token' => true,
            'persist_refresh_token' => true,
            'persist_id_token' => true,
            'audience' => 'audience',
            'response_mode' => 'response_mode',
            'response_type' => 'response_type',
            'scope' => 'scope',
            'debug_mode' => true,
        ]);

        $this->assertEquals('audience', NSA::getProperty($auth0, 'audience'));
        $this->assertEquals('response_mode', NSA::getProperty($auth0, 'response_mode'));
        $this->assertEquals('response_type', NSA::getProperty($auth0, 'response_type'));
        $this->assertEquals('scope', NSA::getProperty($auth0, 'scope'));
        $this->assertEquals(true, NSA::getProperty($auth0, 'debug_mode'));
        $this->assertEquals(['refresh_token', 'access_token', 'id_token'], array_values(NSA::getProperty($auth0, 'persistantMap')));
    }
}
