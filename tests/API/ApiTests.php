<?php

declare(strict_types=1);

namespace Auth0\Tests\API;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\Traits\ErrorHelpers;
use josegonzalez\Dotenv\Loader;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiTests.
 * Extend to test API endpoints with a live or mock API.
 */
class ApiTests extends TestCase
{
    use ErrorHelpers;

    /**
     * Environment variables.
     */
    protected static array $env = [];

    /**
     * Get all test suite environment variables.
     *
     * @throws \Auth0\SDK\Exception\ApiException
     *
     * @return array
     */
    protected static function getEnv(): array
    {
        if (self::$env) {
            return self::$env;
        }

        $env_path = '.env';

        if (file_exists($env_path)) {
            $loader = new Loader($env_path);
            $loader->parse()->putenv(true);
        }

        $env = getenv();

        self::$env = [
            'DOMAIN' => $env['DOMAIN'] ?? false,
            'APP_CLIENT_ID' => $env['APP_CLIENT_ID'] ?? false,
            'APP_CLIENT_SECRET' => $env['APP_CLIENT_SECRET'] ?? false,
            'API_TOKEN' => $env['API_TOKEN'] ?? false,
            'AUTH0_API_REQUEST_DELAY' => (int) ($env['AUTH0_API_REQUEST_DELAY'] ?? 0),
        ];

        if (self::$env['AUTH0_API_REQUEST_DELAY'] <= 0) {
            self::$env['AUTH0_API_REQUEST_DELAY'] = 200000;
        }

        if (! isset($env['API_TOKEN']) && $env['APP_CLIENT_SECRET']) {
            $auth_api = new Authentication($env['DOMAIN'], $env['APP_CLIENT_ID'], $env['APP_CLIENT_SECRET']);
            $response = $auth_api->clientCredentials(['audience' => 'https://' . $env['DOMAIN'] . '/api/v2/']);
            self::$env['API_TOKEN'] = $response['access_token'];
        }

        return self::$env;
    }

    protected static function sleep(?int $microseconds = null): void
    {
        usleep($microseconds ?? self::$env['AUTH0_API_REQUEST_DELAY']);
    }
}
