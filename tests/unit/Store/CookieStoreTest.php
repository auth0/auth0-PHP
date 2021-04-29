<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\Store;

use Auth0\SDK\Store\CookieStore;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class CookieStoreTest.
 * Tests the CookieStore class.
 */
class CookieStoreTest extends TestCase
{
    private static $mockSpyCookie;

    private static $mockSpyHeader;

    /**
     * Run after each test in this suite.
     */
    public function tearDown(): void
    {
        $_COOKIE = [];
        self::$mockSpyCookie = null;
        self::$mockSpyHeader = null;
    }

    /**
     * Create a mock cookie store.
     *
     * @param array $args Additional constructor arguments to pass
     *
     * @return CookieStore|\PHPUnit\Framework\MockObject\MockObject
     */
    public function getMock(array $args = [])
    {
        $mockStore = $this->getMockBuilder(CookieStore::class)
            ->setConstructorArgs([$args])
            ->onlyMethods(['setCookie', 'setCookieHeader'])
            ->getMock();

        $mockStore->expects(self::$mockSpyCookie = $this->any())
            ->method('setCookie')
            ->willReturn(true);

        $mockStore->expects(self::$mockSpyHeader = $this->any())
            ->method('setCookieHeader');

        return $mockStore;
    }

    /**
     * Gain access to PHPUnit's mock invocation stack for analyzing calls.
     * PHPUnit 8.4 removed the native getInvocations property, requiring this workaround.
     *
     * @param object $mock Mock object to reflect.
     *
     * @return array
     */
    public function getMockInvocations(object $mock): array
    {
        $reflector = new ReflectionClass(get_class($mock));
        $invocations = $reflector->getParentClass()->getProperty('invocations');
        $invocations->setAccessible(true);

        return $invocations->getValue($mock);
    }

    /**
     * Test get cookie name
     */
    public function testGetCookieName(): void
    {
        $store = new CookieStore();
        $this->assertEquals('auth0_test_key', $store->getCookieName('test_key'));
    }

    /**
     * Test custom base name
     */
    public function testCustomBaseName(): void
    {
        $store = new CookieStore(['base_name' => 'custom_base']);
        $this->assertEquals('custom_base_test_key', $store->getCookieName('test_key'));

        $store = new CookieStore(['base_name' => 'custom_base_']);
        $this->assertEquals('custom_base__test_key', $store->getCookieName('test_key'));
    }

    /**
     * Test no same-site
     */
    public function testSetNoSameSite(): void
    {
        $mockStore = $this->getMock(['now' => 1, 'expiration' => 1]);
        $mockStore->set('test_set_key', '__test_set_value__');

        $this->assertEquals('__test_set_value__', $_COOKIE['auth0_test_set_key']);
        $this->assertArrayNotHasKey('_auth0_test_set_key', $_COOKIE);

        $this->assertCount(0, (array) $this->getMockInvocations(self::$mockSpyHeader));
        $this->assertCount(1, (array) $this->getMockInvocations(self::$mockSpyCookie));

        $setCookieParams = $this->getMockInvocations(self::$mockSpyCookie)[0]->getParameters();

        $this->assertEquals('auth0_test_set_key', $setCookieParams[0]);
        $this->assertEquals('__test_set_value__', $setCookieParams[1]);
        $this->assertEquals(2, $setCookieParams[2]);
    }

    /**
     * Test same-site: none
     */
    public function testSetSameSiteNone(): void
    {
        $mockStore = $this->getMock(['now' => 10, 'expiration' => 10, 'samesite' => 'None']);
        $mockStore->set('test_set_key', '__test_set_value__');

        $this->assertEquals('__test_set_value__', $_COOKIE['auth0_test_set_key']);
        $this->assertEquals('__test_set_value__', $_COOKIE['_auth0_test_set_key']);

        $this->assertCount(1, (array) $this->getMockInvocations(self::$mockSpyHeader));

        $setHeaderParams = $this->getMockInvocations(self::$mockSpyHeader)[0]->getParameters();

        $this->assertEquals('auth0_test_set_key', $setHeaderParams[0]);
        $this->assertEquals('__test_set_value__', $setHeaderParams[1]);
        $this->assertEquals(20, $setHeaderParams[2]);

        $this->assertCount(1, (array) $this->getMockInvocations(self::$mockSpyCookie));

        $setCookieParams = $this->getMockInvocations(self::$mockSpyCookie)[0]->getParameters();

        $this->assertEquals('_auth0_test_set_key', $setCookieParams[0]);
        $this->assertEquals('__test_set_value__', $setCookieParams[1]);
        $this->assertEquals(20, $setCookieParams[2]);
    }

    /**
     * Test same-site: none (no legacy)
     */
    public function testSetSameSiteNoneNoLegacy(): void
    {
        $mockStore = $this->getMock(['legacy_samesite_none' => false, 'samesite' => 'None']);
        $mockStore->set('test_set_key', '__test_set_value__');

        $this->assertEquals('__test_set_value__', $_COOKIE['auth0_test_set_key']);
        $this->assertArrayNotHasKey('_auth0_test_set_key', $_COOKIE);
        $this->assertCount(0, (array) $this->getMockInvocations(self::$mockSpyCookie));
        $this->assertCount(1, (array) $this->getMockInvocations(self::$mockSpyHeader));

        $setCookieParams = $this->getMockInvocations(self::$mockSpyHeader)[0]->getParameters();

        $this->assertEquals('auth0_test_set_key', $setCookieParams[0]);
        $this->assertEquals('__test_set_value__', $setCookieParams[1]);
        $this->assertGreaterThanOrEqual(time() + 600, $setCookieParams[2]);
    }

    /**
     * Test Get
     */
    public function testGet(): void
    {
        $store = new CookieStore();

        $_COOKIE['auth0_test_get_key'] = '__test_get_value__';
        $_COOKIE['_auth0_test_get_key'] = '__test_get_legacy_value__';

        $this->assertEquals('__test_get_value__', $store->get('test_get_key'));
        $this->assertEquals('__test_default_value__', $store->get('test_empty_key', '__test_default_value__'));

        unset($_COOKIE['auth0_test_get_key']);
        $this->assertEquals('__test_get_legacy_value__', $store->get('test_get_key'));
    }

    /**
     * Test Get No Legacy
     */
    public function testGetNoLegacy(): void
    {
        $store = new CookieStore(['legacy_samesite_none' => false]);

        $_COOKIE['auth0_test_get_key'] = '__test_get_value__';
        $_COOKIE['_auth0_test_get_key'] = '__test_get_legacy_value__';

        $this->assertEquals('__test_get_value__', $store->get('test_get_key'));
        $this->assertEquals('__test_default_value__', $store->get('test_empty_key', '__test_default_value__'));

        unset($_COOKIE['auth0_test_get_key']);
        $this->assertNull($store->get('test_get_key'));
    }

    /**
     * Test Delete
     */
    public function testDelete(): void
    {
        $_COOKIE['auth0_test_delete_key'] = '__test_delete_value__';
        $_COOKIE['_auth0_test_delete_key'] = '__test_delete_value__';

        $mockStore = $this->getMock();
        $mockStore->delete('test_delete_key');

        $this->assertNull($mockStore->get('test_delete_key'));
        $this->assertArrayNotHasKey('auth0_test_delete_key', $_COOKIE);
        $this->assertArrayNotHasKey('_auth0_test_delete_key', $_COOKIE);

        $this->assertCount(0, (array) $this->getMockInvocations(self::$mockSpyHeader));
        $this->assertCount(2, (array) $this->getMockInvocations(self::$mockSpyCookie));

        $setCookieParams = $this->getMockInvocations(self::$mockSpyCookie)[0]->getParameters();

        $this->assertEquals('auth0_test_delete_key', $setCookieParams[0]);
        $this->assertEquals('', $setCookieParams[1]);
        $this->assertEquals(0, $setCookieParams[2]);

        $setCookieParams = $this->getMockInvocations(self::$mockSpyCookie)[1]->getParameters();

        $this->assertEquals('_auth0_test_delete_key', $setCookieParams[0]);
        $this->assertEquals('', $setCookieParams[1]);
        $this->assertEquals(0, $setCookieParams[2]);
    }

    /**
     * Test Delete No Legacy
     */
    public function testDeleteNoLegacy(): void
    {
        $_COOKIE['auth0_test_delete_key'] = '__test_delete_value__';
        $_COOKIE['_auth0_test_delete_key'] = '__test_delete_value__';

        $mockStore = $this->getMock(['legacy_samesite_none' => false]);
        $mockStore->delete('test_delete_key');

        $this->assertNull($mockStore->get('test_delete_key'));
        $this->assertArrayNotHasKey('auth0_test_delete_key', $_COOKIE);
        $this->assertArrayHasKey('_auth0_test_delete_key', $_COOKIE);

        $this->assertCount(1, (array) $this->getMockInvocations(self::$mockSpyCookie));

        $setCookieParams = $this->getMockInvocations(self::$mockSpyCookie)[0]->getParameters();

        $this->assertEquals('auth0_test_delete_key', $setCookieParams[0]);
        $this->assertEquals('', $setCookieParams[1]);
        $this->assertEquals(0, $setCookieParams[2]);
    }

    /**
     * Test Get Set Cookie Header Strict
     */
    public function testGetSetCookieHeaderStrict(): void
    {
        $store = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'lax']);
        $method = new \ReflectionMethod(CookieStore::class, 'getSameSiteCookieHeader');
        $method->setAccessible(true);
        $header = $method->invokeArgs($store, ['__test_name_1__', '__test_value_1__', 303943620]);

        $this->assertEquals(
            'Set-Cookie: __test_name_1__=__test_value_1__; path=/; ' . 'expires=Sunday, 19-Aug-1979 20:47:00 GMT; HttpOnly; SameSite=Lax',
            $header
        );
    }

    /**
     * Test Get Set Cookie Header None
     */
    public function testGetSetCookieHeaderNone(): void
    {
        $store = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'none']);
        $method = new \ReflectionMethod(CookieStore::class, 'getSameSiteCookieHeader');
        $method->setAccessible(true);
        $header = $method->invokeArgs($store, ['__test_name_2__', '__test_value_2__', 303943620]);

        $this->assertEquals(
            'Set-Cookie: __test_name_2__=__test_value_2__; path=/; ' . 'expires=Sunday, 19-Aug-1979 20:47:00 GMT; HttpOnly; SameSite=None; Secure',
            $header
        );
    }

    /**
     * Test Set Cookie Header Fails With Invalid Cookie Name
     */
    public function testSetCookieHeaderFailsWithInvalidCookieName(): void
    {
        $store = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'none']);
        $method = new \ReflectionMethod(CookieStore::class, 'getSameSiteCookieHeader');
        $method->setAccessible(true);
        $methodArgs = ['__test_invalid_name_;__', uniqid(), mt_rand(1000, 9999)];

        $this->expectExceptionMessage("Cookie names cannot contain any of the following ',; \\t\\r\\n\\013\\014'");

        $header = $method->invokeArgs($store, $methodArgs);

        $this->assertEquals('', $header);
    }

    /**
     * Test Set Cookie Header Fails With Invalid Cookie Value
     */
    public function testSetCookieHeaderFailsWithInvalidCookieValue(): void
    {
        $store = new CookieStore(['now' => 303943620, 'expiration' => 0, 'samesite' => 'none']);
        $method = new \ReflectionMethod(CookieStore::class, 'getSameSiteCookieHeader');
        $method->setAccessible(true);
        $methodArgs = [uniqid(), '__test_invalid_value_;__', mt_rand(1000, 9999)];

        $this->expectExceptionMessage("Cookie values cannot contain any of the following ',; \\t\\r\\n\\013\\014'");

        $header = $method->invokeArgs($store, $methodArgs);

        $this->assertEquals('', $header);
    }
}
