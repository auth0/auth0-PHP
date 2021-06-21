<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\SessionStore;
use PHPUnit\Framework\TestCase;

/**
 * Class SessionStoreTest.
 * Tests the SessionStore class.
 */
class SessionStoreTest extends TestCase
{
    /**
     * Session key for test values.
     */
    protected const TEST_KEY = 'never_compromise_on_identity';

    /**
     * Session value to test.
     */
    protected const TEST_VALUE = '__Auth0__';

    /**
     * Run after each test in this suite.
     */
    public function tearDown(): void
    {
        $_SESSION = [];
    }

    /**
     * Run before each test in this suite.
     */
    public function setUp(): void
    {
        $this->configuration = new SdkConfiguration([
            'domain' => uniqid(),
            'clientId' => uniqid(),
            'cookieSecret' => uniqid(),
            'clientSecret' => uniqid(),
            'redirectUri' => uniqid(),
        ]);

        $this->store = new SessionStore($this->configuration, 'test');
    }

    /**
     * Test that SessionStore::set stores the correct value.
     */
    public function testSet(): void
    {
        // Make sure this key does not exist yet so we can test that it was set.
        $_SESSION = [];

        // Suppressing "headers already sent" warning related to cookies.
        $this->store->set(self::TEST_KEY, self::TEST_VALUE);

        $this->assertEquals(self::TEST_VALUE, $_SESSION['test_' . self::TEST_KEY]);
    }

    /**
     * Test that SessionStore::get stores the correct value.
     */
    public function testGet(): void
    {
        $_SESSION['test_' . self::TEST_KEY] = self::TEST_VALUE;
        $this->assertEquals(self::TEST_VALUE, $this->store->get(self::TEST_KEY));
    }

    /**
     * Test that SessionStore::delete trashes the stored value.
     */
    public function testDelete(): void
    {
        $_SESSION['test_' . self::TEST_KEY] = self::TEST_VALUE;
        $this->assertTrue(isset($_SESSION['test_' . self::TEST_KEY]));

        $this->store->delete(self::TEST_KEY);

        $this->assertNull($this->store->get(self::TEST_KEY));
        $this->assertFalse(isset($_SESSION['test_' . self::TEST_KEY]));
    }
}
