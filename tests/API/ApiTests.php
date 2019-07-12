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
        if (empty( self::$env )) {
            $env_path = '.env';
            if (file_exists($env_path)) {
                $loader = new Loader($env_path);
                $loader->parse()->putenv(true);
            }

            $auth_api = new Authentication( getenv('DOMAIN'), getenv('APP_CLIENT_ID'), getenv('APP_CLIENT_SECRET') );
            $response = $auth_api->client_credentials( [ 'audience' => 'https://'.getenv('DOMAIN').'/api/v2/' ] );

            self::$env = [
                'DOMAIN' => getenv('DOMAIN'),
                'APP_CLIENT_ID' => getenv('APP_CLIENT_ID'),
                'APP_CLIENT_SECRET' => getenv('APP_CLIENT_SECRET'),
                'API_TOKEN' => $response['access_token'],
            ];
        }

        return self::$env;
    }

    /**
     * Get a Management API token for specific scopes.
     *
     * @param array $env    Environment variables.
     *
     * @return string
     */
    protected static function getToken(array $env)
    {
        return $env['API_TOKEN'];
    }

    /**
     * Return an API client used during self::setUpBeforeClass().
     *
     * @param string $endpoint   Endpoint name used for token generation.
     *
     * @return mixed
     *
     * @throws \Auth0\SDK\Exception\ApiException
     */
    protected static function getApi($endpoint)
    {
        self::getEnv();
        $token      = self::getToken(self::$env);
        $api_client = new Management($token, self::$env['DOMAIN']);
        return $api_client->$endpoint;
    }
}
