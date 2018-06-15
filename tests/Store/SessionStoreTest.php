<?php

use Auth0\SDK\Store\SessionStore;

/**
 * Class SessionStoreTest.
 * Tests the SessionStore class.
 */
class SessionStoreTest extends PHPUnit_Framework_TestCase
{
  /**
   * Session key for test values.
   */
    const TEST_KEY = 'never_compromise_on_identity';

  /**
   * Session value to test.
   */
    const TEST_VALUE = '__Auth0__';

  /**
   * Expected cookie lifetime of 1 week.
   * 60 s/min * 60 min/h * 24 h/day * 7 days.
   */
    const COOKIE_LIFETIME = 604800;

  /**
   * Reusable instance of SessionStore class to be tested.
   *
   * @var SessionStore
   */
    public static $sessionStore;

  /**
   * Session key base name pulled from SessionStore constant on setup.
   *
   * @var string
   */
    public static $sessionKeyBase;

  /**
   * Full session array key.
   *
   * @var string
   */
    public static $sessionKey;

  /**
   * Test fixture for class, runs once before any tests.
   *
   * @throws \Exception
   */
    public static function setUpBeforeClass()
    {
        // Suppressing "headers already sent" warning related to cookies.
        @self::$sessionStore = new SessionStore();
        self::$sessionKeyBase = 'auth0_';
        self::$sessionKey = self::$sessionKeyBase . '_' . self::TEST_KEY;
    }

  /**
   * Test that SessionStore::initSession ran and cookie params are stored correctly.
   */
    public function testInitSession()
    {
        $this->assertNotEmpty(session_id());
        $cookieParams = session_get_cookie_params();
        $this->assertEquals(self::COOKIE_LIFETIME, $cookieParams['lifetime']);
    }

  /**
   * Test that SessionStore::getSessionKeyName returns the expected name.
   */
    public function testGetSessionKey()
    {
        $test_this_key_name = self::$sessionStore->getSessionKeyName(self::TEST_KEY);
        $this->assertEquals(self::$sessionKey, $test_this_key_name);
    }

  /**
   * Test that SessionStore::set stores the correct value.
   */
    public function testSet()
    {
        self::$sessionStore->set(self::TEST_KEY, self::TEST_VALUE);
        $this->assertEquals($_SESSION[self::$sessionKey], self::TEST_VALUE);
    }

  /**
   * Test that SessionStore::get stores the correct value.
   */
    public function testGet()
    {
        $this->assertFalse(isset($_SESSION[self::$sessionKey]));
        $_SESSION[self::$sessionKey] = self::TEST_VALUE;
        $test_this_value = self::$sessionStore->get(self::TEST_KEY);
        $this->assertEquals(self::TEST_VALUE, $test_this_value);
    }

  /**
   * Test that SessionStore::delete trashes the stored value.
   */
    public function testDelete()
    {
        self::$sessionStore->delete(self::TEST_KEY);
        $this->assertNull(self::$sessionStore->get(self::TEST_KEY));
        $this->assertFalse(isset($_SESSION[self::$sessionKey]));
    }
}
