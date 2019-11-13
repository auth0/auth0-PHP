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
        $this->assertEquals('auth0_test_key', $store->getCookieName('test_key'));
    }

    public function testCustomBaseName()
    {
        $store = new CookieStore('custom_base');
        $this->assertEquals('custom_base_test_key', $store->getCookieName('test_key'));
    }

    public function testCustomExpiration()
    {
        $mockStore = $this->getMockBuilder(CookieStore::class)
            ->setConstructorArgs([uniqid(), 1200])
            ->setMethods(['setCookie'])
            ->getMock();
        $mockStore->expects($mockSpy = $this->any())->method('setCookie')->willReturn(true);
        $mockStore->set(uniqid(), uniqid());

        $setCookieParams = $mockSpy->getInvocations()[0]->getParameters();
        $this->assertEquals(1200, $setCookieParams[2]);
    }

    public function testSet()
    {
        self::$mockStore->set('test_set_key', '__test_set_value__');

        $this->assertEquals('__test_set_value__', $_COOKIE['auth0_test_set_key']);
        $this->assertCount(1, (array) self::$mockSpy->getInvocations());

        $setCookieParams = self::$mockSpy->getInvocations()[0]->getParameters();

        $this->assertEquals('auth0_test_set_key', $setCookieParams[0]);
        $this->assertEquals('__test_set_value__', $setCookieParams[1]);
        $this->assertEquals(600, $setCookieParams[2]);
    }

    public function testGet()
    {
        $store                         = new CookieStore();
        $_COOKIE['auth0_test_get_key'] = '__test_get_value__';

        $this->assertEquals('__test_get_value__', $store->get('test_get_key'));
        $this->assertEquals('__test_default_value__', $store->get('test_empty_key', '__test_default_value__'));
    }

    public function testDelete()
    {
        $_COOKIE['auth0_test_delete_key'] = '__test_delete_value__';

        self::$mockStore->delete('test_delete_key');

        $this->assertNull(self::$mockStore->get('test_delete_key'));
        $this->assertArrayNotHasKey('auth0_test_delete_key', $_COOKIE);
        $this->assertCount(1, (array) self::$mockSpy->getInvocations());

        $setCookieParams = self::$mockSpy->getInvocations()[0]->getParameters();

        $this->assertEquals('auth0_test_delete_key', $setCookieParams[0]);
        $this->assertEquals('', $setCookieParams[1]);
        $this->assertEquals(0, $setCookieParams[2]);
    }
}
