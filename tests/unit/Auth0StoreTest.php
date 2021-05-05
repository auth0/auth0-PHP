<?php

declare(strict_types=1);

namespace Auth0\Tests\unit;

use Auth0\SDK\Auth0;
use Auth0\SDK\Store\EmptyStore;
use Auth0\SDK\Store\SessionStore;
use Auth0\Tests\Traits\ErrorHelpers;
use PHPUnit\Framework\TestCase;

/**
 * Class Auth0StoreTest.
 */
class Auth0StoreTest extends TestCase
{
    use ErrorHelpers;

    /**
     * Basic Auth0 class config options.
     */
    public static array $baseConfig;

    /**
     * Runs after each test completes.
     */
    public function setUp(): void
    {
        parent::setUp();

        self::$baseConfig = [
            'domain' => '__test_domain__',
            'client_id' => '__test_client_id__',
            'redirect_uri' => '__test_redirect_uri__',
            'scope' => 'openid',
        ];
    }

    /**
     * Runs after each test completes.
     */
    public function tearDown(): void
    {
        parent::tearDown();
        $_GET = [];
        $_SESSION = [];
    }

    /**
     * Test that passed in store interface is used.
     */
    public function testThatPassedInStoreInterfaceIsUsed(): void
    {
        $storeMock = new class () extends EmptyStore {
            /**
             * Example of an empty store.
             *
             * @param string      $key     An example key.
             * @param string|null $default An example default value.
             *
             * @return mixed
             */
            public function get(string $key, ?string $default = null)
            {
                $response = '__test_custom_store__' . $key . '__';

                if ($key === 'user') {
                    return [ $response ];
                }

                return $response;
            }
        };

        $auth0 = new Auth0(self::$baseConfig + ['store' => $storeMock]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['store' => $storeMock]);
        $this->assertEquals(['__test_custom_store__user__'], $auth0->getUser());
    }

    /**
     * Test that session store is used as default.
     */
    public function testThatSessionStoreIsUsedAsDefault(): void
    {
        $auth0 = new Auth0(self::$baseConfig);
        $auth0->setUser(['sub' => '__test_user__']);

        $this->assertEquals($_SESSION['auth0_user'], $auth0->getUser());
    }

    /**
     * Test that session store is used if passed is invalid.
     */
    public function testThatSessionStoreIsUsedIfPassedIsInvalid(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['store' => new \stdClass()]);
        $auth0->setUser(['sub' => '__test_user__']);

        $this->assertEquals($_SESSION['auth0_user'], $auth0->getUser());
    }

    /**
     * Test that cookie store is used as default transient.
     */
    public function testThatCookieStoreIsUsedAsDefaultTransient(): void
    {
        $auth0 = new Auth0(self::$baseConfig);
        @$auth0->getLoginUrl(['nonce' => '__test_cookie_nonce__']);

        $this->assertEquals('__test_cookie_nonce__', $_COOKIE['auth0_nonce']);
    }

    /**
     * Test that transient can be set to another store interfacec.
     */
    public function testThatTransientCanBeSetToAnotherStoreInterface(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['transient_store' => new SessionStore()]);
        @$auth0->getLoginUrl(['nonce' => '__test_session_nonce__']);

        $this->assertEquals('__test_session_nonce__', $_SESSION['auth0_nonce']);
    }

    /**
     * Test that empty store interface stores nothing.
     */
    public function testThatEmptyStoreInterfaceStoresNothing(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['store' => new EmptyStore()]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig);
        $this->assertNull($auth0->getUser());
    }

    /**
     * Test that no user persistence uses empty store.
     */
    public function testThatNoUserPersistenceUsesEmptyStore(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['persist_user' => false]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['persist_user' => false]);
        $this->assertNull($auth0->getUser());
    }
}
