<?php
namespace Auth0\Tests\API;

use Auth0\Tests\Traits\ErrorHelpers;
use Auth0\SDK\API\Helpers\TokenGenerator;
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
     */
    protected static function getEnv()
    {
        if (empty( self::$env )) {
            $env_path = '.env';
            if (file_exists($env_path)) {
                $loader = new Loader($env_path);
                $loader->parse()->putenv(true);
            }

            self::$env = [
                'GLOBAL_CLIENT_ID' => getenv('GLOBAL_CLIENT_ID'),
                'GLOBAL_CLIENT_SECRET' => getenv('GLOBAL_CLIENT_SECRET'),
                'APP_CLIENT_ID' => getenv('APP_CLIENT_ID'),
                'APP_CLIENT_SECRET' => getenv('APP_CLIENT_SECRET'),
                'NIC_ID' => getenv('NIC_ID'),
                'NIC_SECRET' => getenv('NIC_SECRET'),
                'DOMAIN' => getenv('DOMAIN'),
            ];
        }

        return self::$env;
    }

    /**
     * Get a Management API token for specific scopes.
     *
     * @param array $env    Environment variables.
     * @param array $scopes Token scopes.
     *
     * @return string
     */
    protected static function getToken(array $env, array $scopes)
    {
        $generator = new TokenGenerator( $env['GLOBAL_CLIENT_ID'], $env['GLOBAL_CLIENT_SECRET'] );
        return $generator->generate($scopes);
    }

    /**
     * Return an API client used during self::setUpBeforeClass().
     *
     * @param string $endpoint   Endpoint name used for token generation.
     * @param array  $actions    Actions required for token generation.
     * @param array  $returnType Return type.
     *
     * @return mixed
     */
    protected static function getApi($endpoint, array $actions, array $returnType = null)
    {
        self::getEnv();
        $token      = self::getToken(self::$env, [$endpoint => ['actions' => $actions]]);
        $api_client = new Management($token, self::$env['DOMAIN'], [], $returnType);
        return $api_client->$endpoint;
    }
}
