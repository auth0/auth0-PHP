<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Store;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\CookieStore;
use Auth0\SDK\Store\InMemoryStorage;
use PHPUnit\Framework\TestCase;

/**
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class InMemoryTest extends TestCase
{
    public function testSetGet(): void
    {
        $store = new InMemoryStorage();
        $store->set('test_set_key', '__test_set_value__');
        $this->assertSame('__test_set_value__', $store->get('test_set_key'));
        $this->assertSame(null, $store->get('missing_key'));
    }

    public function testGetDefault(): void
    {
        $store = new InMemoryStorage();
        $store->set('test_set_key', null);
        $this->assertSame(null, $store->get('test_set_key', 'foobar'));
        $this->assertSame('foobar', $store->get('missing_key', 'foobar'));
        $this->assertSame(null, $store->get('missing_key'));
    }

    public function testDelete(): void
    {
        $store = new InMemoryStorage();
        $store->set('test_set_key', '__test_set_value__');

        $store->delete('test_set_key');
        $this->assertNull($store->get('test_set_key'));
    }

    public function testDeleteAll(): void
    {
        $store = new InMemoryStorage();
        $store->set('test_set_key', '__test_set_value__');

        $store->deleteAll();
        $this->assertNull($store->get('test_set_key'));
    }
}
