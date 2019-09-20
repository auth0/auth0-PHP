<?php
namespace Auth0\Tests\API;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\Traits\ErrorHelpers;
use Auth0\SDK\API\Management;
use josegonzalez\Dotenv\Loader;

/**
 * Class ApiTests.
 * Extend to test API endpoints with a live or mock API.
 *
 * @package Auth0\Tests\API
 */
class ApiTests extends \PHPUnit_Framework_TestCase
{
    use ErrorHelpers;

    /**
     * Environment variables.
     *
     * @var array
     */
    protected static $env = [];

    /**
     * Get all test suite environment variables.
     *
     * @return array
     *
     * @throws \Auth0\SDK\Exception\ApiException
     */
    protected static function getEnv()
    {
        if (self::$env) {
            return self::$env;
        }

        $env_path = '.env';
        if (file_exists($env_path)) {
            $loader = new Loader($env_path);
            $loader->parse()->putenv(true);
        }

        $env = [
            'DOMAIN' => getenv('DOMAIN'),
            'APP_CLIENT_ID' => getenv('APP_CLIENT_ID'),
            'APP_CLIENT_SECRET' => getenv('APP_CLIENT_SECRET'),
            'API_TOKEN' => getenv('API_TOKEN'),
        ];

        if (! $env['API_TOKEN'] && $env['APP_CLIENT_SECRET']) {
            $auth_api         = new Authentication( $env['DOMAIN'], $env['APP_CLIENT_ID'], $env['APP_CLIENT_SECRET'] );
            $response         = $auth_api->client_credentials( [ 'audience' => 'https://'.$env['DOMAIN'].'/api/v2/' ] );
            $env['API_TOKEN'] = $response['access_token'];
        }

        self::$env = $env;
        return self::$env;
    }
}
