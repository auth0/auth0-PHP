<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Utility;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Utility\TransientStoreHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class TransientStoreHandlerTest.
 */
class TransientStoreHandlerTest extends TestCase
{
    public function setUp(): void
    {
        $this->configuration = new SdkConfiguration([
            'domain' => uniqid(),
            'clientId' => uniqid(),
            'cookieSecret' => uniqid(),
            'clientSecret' => uniqid(),
            'redirectUri' => uniqid(),
        ]);

        $this->sessionStore = new SessionStore($this->configuration, 'test_store');
        $this->transientStore = new TransientStoreHandler($this->sessionStore);
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $_SESSION = [];
    }

    public function testThatTransientIsStored(): void
    {
        $this->transientStore->store('test_store_key', '__test_store_value__');

        $this->assertEquals('__test_store_value__', $_SESSION['test_store_test_store_key']);
    }

    public function testThatTransientIsIssued(): void
    {
        $issuedValue = $this->transientStore->issue('test_issue_key');

        $this->assertEquals($issuedValue, $_SESSION['test_store_test_issue_key']);
        $this->assertGreaterThanOrEqual(16, mb_strlen($issuedValue));
    }

    public function testThatTransientIsGottenOnce(): void
    {
        $this->transientStore->store('test_get_key', '__test_get_value__');

        $this->assertEquals('__test_get_value__', $this->transientStore->getOnce('test_get_key'));
        $this->assertNull($this->transientStore->getOnce('test_get_key'));
        $this->assertArrayNotHasKey('test_store_test_get_key', $_SESSION);
    }

    public function testThatTransientIsVerified(): void
    {
        $this->transientStore->store('test_verify_key', '__test_get_value__');

        $this->assertTrue($this->transientStore->verify('test_verify_key', '__test_get_value__'));
        $this->assertFalse($this->transientStore->verify('test_verify_key', '__test_get_value__'));
        $this->assertNull($this->transientStore->getOnce('test_verify_key'));
        $this->assertArrayNotHasKey('test_store_test_verify_key', $_SESSION);
    }

    public function testThatTransientIssetReturnsCorrectly(): void
    {
        $this->assertFalse($this->transientStore->isset('test_verify_key'));

        $this->transientStore->store('test_verify_key', '__test_get_value__');

        $this->assertTrue($this->transientStore->isset('test_verify_key'));

        $this->transientStore->getOnce('test_verify_key');

        $this->assertFalse($this->transientStore->isset('test_verify_key'));
    }
}
