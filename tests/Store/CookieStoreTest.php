<?php
namespace Auth0\Tests\Store;

use Auth0\SDK\Store\CookieStore;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount;

/**
 * Class CookieStoreTest.
 * Tests the CookieStore class.
 */
class CookieStoreTest extends TestCase
{

    /**
     * Mock CookieStore instance to skip setcookie() call.
     *
     * @var CookieStore
     */
    public static $mockStore;

    /**
     * Mock spy for calls to setCookie.
     *
     * @var AnyInvokedCount
     */
    public static $mockSpy;

    /**
     * Run before all tests in this suite.
     */
    public function setUp()
    {
        self::$mockStore = $this->getMockBuilder(CookieStore::class)->setMethods(['setCookie'])->getMock();
        self::$mockStore->expects(self::$mockSpy = $this->any())->method('setCookie')->willReturn(true);
    }

    /**
     * Run after each test in this suite.
     */
    public function tearDown()
    {
        $_COOKIE = [];
    }

    public function testGetCookieName()
    {
        $store = new CookieStore();
        $this->assertEquals('auth0__test_key', $store->getCookieName('test_key'));
    }

    public function testCustomBaseName()
    {
        $store = new CookieStore(['base_name' => 'custom_base']);
        $this->assertEquals('custom_base_test_key', $store->getCookieName('test_key'));
    }

    public function testSet()
    {
        self::$mockStore->set('test_set_key', '__test_set_value__');

        $this->assertEquals('__test_set_value__', $_COOKIE['auth0__test_set_key']);
        $this->assertCount(1, (array) self::$mockSpy->getInvocations());

        $setCookieParams = self::$mockSpy->getInvocations()[0]->getParameters();

        $this->assertEquals('auth0__test_set_key', $setCookieParams[0]);
        $this->assertEquals('__test_set_value__', $setCookieParams[1]);
    }

    public function testGet()
    {
        $store                          = new CookieStore();
        $_COOKIE['auth0__test_get_key'] = '__test_get_value__';

        $this->assertEquals('__test_get_value__', $store->get('test_get_key'));
        $this->assertEquals('__test_default_value__', $store->get('test_empty_key', '__test_default_value__'));
    }

    public function testDelete()
    {
        $_COOKIE['auth0__test_delete_key'] = '__test_delete_value__';

        self::$mockStore->delete('test_delete_key');

        $this->assertNull(self::$mockStore->get('test_delete_key'));
        $this->assertArrayNotHasKey('auth0__test_delete_key', $_COOKIE);
        $this->assertCount(1, (array) self::$mockSpy->getInvocations());

        $setCookieParams = self::$mockSpy->getInvocations()[0]->getParameters();

        $this->assertEquals('auth0__test_delete_key', $setCookieParams[0]);
        $this->assertEquals('', $setCookieParams[1]);
    }

    public function testGetSetCookieHeaderDefault()
    {
        $store        = new CookieStore(['now' => 303943620, 'expiration' => 0]);

        $header = $store->getSetCookieHeader('__test_name_1__', '__test_value_1__');
        $this->assertEquals(
            '__test_name_1__=__test_value_1__; path=/; expires=Sunday, 19-Aug-1979 20:47:00 GMT; HttpOnly; SameSite=Lax',
            $header
        );
    }

    public function testGetSetCookieHeaderStrict()
    {
        $store        = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'strict']);

        $header = $store->getSetCookieHeader('__test_name_1__', '__test_value_1__');
        $this->assertEquals(
            '__test_name_1__=__test_value_1__; path=/; expires=Sunday, 19-Aug-1979 20:47:00 GMT; HttpOnly; SameSite=Strict',
            $header
        );
    }

    public function testGetSetCookieHeaderNone()
    {
        $store        = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'none']);

        $header = $store->getSetCookieHeader('__test_name_1__', '__test_value_1__');
        $this->assertEquals(
            '__test_name_1__=__test_value_1__; path=/; expires=Sunday, 19-Aug-1979 20:47:00 GMT; HttpOnly; SameSite=None; Secure',
            $header
        );
    }
}
