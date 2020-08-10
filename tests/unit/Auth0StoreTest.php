<?php
namespace Auth0\Tests\unit;

use Auth0\SDK\Auth0;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Store\StoreInterface;
use Auth0\Tests\Traits\ErrorHelpers;
use PHPUnit\Framework\TestCase;

/**
 * Class Auth0StoreTest
 *
 * @package Auth0\Tests\unit
 */
class Auth0StoreTest extends TestCase
{

    use ErrorHelpers;

    /**
     * Basic Auth0 class config options.
     *
     * @var array
     */
    public static $baseConfig;

    /**
     * Runs after each test completes.
     */
    public function setUp()
    {
        parent::setUp();

        self::$baseConfig = [
            'domain'        => '__test_domain__',
            'client_id'     => '__test_client_id__',
            'redirect_uri'  => '__test_redirect_uri__',
            'scope' => 'openid',
        ];
    }

    /**
     * Runs after each test completes.
     */
    public function tearDown()
    {
        parent::tearDown();
        $_GET     = [];
        $_SESSION = [];
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatPassedInStoreInterfaceIsUsed()
    {
        $storeMock = new class extends EmptyStore {
            public function get(string $key, $default = null)
            {
                return '__test_custom_store__' . $key . '__';
            }
        };

        $auth0 = new Auth0(self::$baseConfig + ['store' => $storeMock]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['store' => $storeMock]);
        $this->assertEquals('__test_custom_store__user__', $auth0->getUser());
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatSessionStoreIsUsedAsDefault()
    {
        $auth0 = new Auth0(self::$baseConfig);
        $auth0->setUser(['sub' => '__test_user__']);

        $this->assertEquals($_SESSION['auth0__user'], $auth0->getUser());
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatSessionStoreIsUsedIfPassedIsInvalid()
    {
        $auth0 = new Auth0(self::$baseConfig + ['store' => new \stdClass()]);
        $auth0->setUser(['sub' => '__test_user__']);

        $this->assertEquals($_SESSION['auth0__user'], $auth0->getUser());
    }

    public function testThatCookieStoreIsUsedAsDefaultTransient()
    {
        $auth0 = new Auth0(self::$baseConfig);
        @$auth0->getLoginUrl(['nonce' => '__test_cookie_nonce__']);

        $this->assertEquals('__test_cookie_nonce__', $_COOKIE['auth0__nonce']);
    }

    public function testThatTransientCanBeSetToAnotherStoreInterface()
    {
        $auth0 = new Auth0(self::$baseConfig + ['transient_store' => new SessionStore()]);
        @$auth0->getLoginUrl(['nonce' => '__test_session_nonce__']);

        $this->assertEquals('__test_session_nonce__', $_SESSION['auth0__nonce']);
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatEmptyStoreInterfaceStoresNothing()
    {
        $auth0 = new Auth0(self::$baseConfig + ['store' => new EmptyStore()]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig);
        $this->assertNull($auth0->getUser());
    }

    /**
     * @throws ApiException Should not be thrown in this test.
     * @throws CoreException Should not be thrown in this test.
     */
    public function testThatNoUserPersistenceUsesEmptyStore()
    {
        $auth0 = new Auth0(self::$baseConfig + ['persist_user' => false]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['persist_user' => false]);
        $this->assertNull($auth0->getUser());
    }
}
