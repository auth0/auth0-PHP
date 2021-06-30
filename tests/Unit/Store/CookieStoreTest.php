<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * Class CookieStoreTest.
 * Tests the CookieStore class.
 */
class CookieStoreTest extends TestCase
{
    private CookieStore $store;

    /**
     * Run after each test in this suite.
     */
    public function tearDown(): void
    {
        $_COOKIE = [];
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

        $this->store = new CookieStore($this->configuration);
    }

    /**
     * Test Set
     */
    public function testSet(): void
    {
        $cookieCount = count($_COOKIE);

        $this->store->set('test_set_key', '__test_set_value__');
        $this->assertEquals($cookieCount + 1, count($_COOKIE));
        $this->assertEquals('__test_set_value__', $this->store->get('test_set_key'));
    }

    /**
     * Test Get
     */
    public function testGet(): void
    {
        $this->store->set('test_set_key', '__test_set_value__');
        $this->assertEquals('__test_set_value__', $this->store->get('test_set_key'));
        $this->assertEquals(null, $this->store->get('missing_key'));
    }

    /**
     * Test Delete
     */
    public function testDelete(): void
    {
        $cookieCount = count($_COOKIE);

        $this->store->set('test_set_key', '__test_set_value__');
        $this->assertEquals($cookieCount + 1, count($_COOKIE));

        $this->store->delete('test_set_key');
        $this->assertEquals($cookieCount, count($_COOKIE));
    }
}
