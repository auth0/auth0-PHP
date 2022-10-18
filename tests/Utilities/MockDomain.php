<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

class MockDomain
{
    public static function startsWith()
    {
        return 'https://testing123.';
    }

    public static function endsWith()
    {
        return '.auth0.test';
    }

    public static function valid()
    {
        return self::startsWith() . mt_rand() . '.' . uniqid() . self::endsWith();
    }

    public static function invalid()
    {
        return uniqid();
    }
}
