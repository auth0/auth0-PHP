<?php
namespace Auth0\Tests\API;

use Auth0\Tests\Traits\ErrorHelpers;
use Auth0\SDK\API\Helpers\TokenGenerator;
use Auth0\SDK\API\Management;
use Auth0\SDK\API\Management\GenericResource;

use josegonzalez\Dotenv\Loader;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;

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
     * Domain to use for the mock API.
     */
    const MOCK_API_DOMAIN = 'api.test.local';

    /**
     * Base API URL for the mock API.
     */
    const MOCK_API_BASE_URL = 'https://api.test.local/api/v2/';

    /**
     * Dummy API token to use on mock requests.
     */
    const MOCK_API_TOKEN = '__api_token__';

    /**
     * Environment variables.
     *
     * @var array
     */
    protected static $env = [];

    /**
     * API endpoint.
     *
     * @var string
     */
    protected static $endpoint;

    /**
     * Guzzle history container for mock API.
     *
     * @var array
     */
    protected static $mockContainer = [];

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
     * @return GenericResource
     */
    protected static function getApi($endpoint, array $actions, array $returnType = null)
    {
        self::getEnv();
        $token      = self::getToken(self::$env, [$endpoint => ['actions' => $actions]]);
        $api_client = new Management($token, self::$env['DOMAIN'], [], $returnType);
        return $api_client->$endpoint;
    }

    /**
     * Create a mock API handler from an array of Responses and activate the History middleware.
     *
     * @param array $responses Responses to be loaded, an array of Response objects.
     *
     * @return GenericResource
     */
    protected static function getMockApi(array $responses)
    {
        static::$mockContainer = [];
        $mock    = new MockHandler($responses);
        $handler = HandlerStack::create($mock);

        $handler->push( Middleware::history(static::$mockContainer) );
        $guzzleOptions['handler'] = $handler;

        $api_client = new Management('__api_token__', self::MOCK_API_DOMAIN, $guzzleOptions, 'object');
        return $api_client->{self::$endpoint};
    }

    /**
     * Does an error message contain a specific string?
     *
     * @param \Exception $e   Error object.
     * @param string     $str String to find in the error message.
     *
     * @return boolean
     */
    protected function errorHasString(\Exception $e, $str)
    {
        return ! (false === strpos($e->getMessage(), $str));
    }

    /**
     * Get text fixture JSON for a specific endpoint.
     *
     * @param array $filter Key is the property to filter, value is the value to filter by.
     * @param array $paged  First element is the page number, second is the number per page.
     * @param array $fields First element is an array of fields, second is whether to include (true) or exclude.
     *
     * @return string
     */
    protected static function getJson(
        array $filter = [],
        array $paged = [0, null],
        array $fields = [[], true]
    )
    {
        $file_path     = AUTH0_PHP_TEST_JSON_DIR.'m-api-'.self::$endpoint.'.json';
        $json_contents = file_get_contents( $file_path );
        $data          = json_decode( $json_contents, true );

        // Filter by a specific attribute.
        if (! empty( $filter )) {
            // Filter array key is the attribute.
            $filter_key = array_keys($filter)[0];
            $filter_val = $filter[$filter_key];
            foreach ($data as $index => $datum) {
                // Remove data that does not pass the filter check.
                if ($datum[$filter_key] !== $filter_val) {
                    unset($data[$index]);
                }
            }
        }

        // Pagination.
        if (! empty( $paged[1] )) {
            $data = array_slice($data, $paged[0] * $paged[1], $paged[1]);
        }

        // Fields to include/exclude.
        if (! empty( $fields[0] )) {
            // Switch field values to keys.
            $check_fields = array_flip( $fields[0] );
            foreach ($data as $index => $datum) {
                if ($fields[1]) {
                    // Keep the keys indicated.
                    $data[$index] = array_intersect_key( $datum, $check_fields );
                } else {
                    // Remove the keys indicated.
                    $data[$index] = array_diff_key( $datum, $check_fields );
                }
            }
        }

        return array_values( $data );
    }

    /**
     * Get a Guzzle history record from an array populated by Middleware::history().
     *
     * @param integer $index History index to get.
     *
     * @return Request
     */
    protected static function getMockRequestHistory($index = 0)
    {
        return self::$mockContainer[$index]['request'];
    }

    /**
     * Check that the default header keys are being sent.
     *
     * @param array $headers Headers sent.
     *
     * @return void
     */
    protected function assertHeaders(array $headers)
    {
        $this->assertNotEmpty( $headers['Auth0-Client'] );
        $this->assertNotEmpty( $headers['Authorization'] );
        $this->assertEquals( 'Bearer '.self::MOCK_API_TOKEN, $headers['Authorization'][0] );
    }

    /**
     * Assert whether the called URI matches the correct one.
     *
     * @param Request $request Request object to get the URI.
     * @param string  $path    Additional path string after base endpoint.
     *
     * @return void
     */
    protected function assertUri(Request $request, $path = '')
    {
        $this->assertEquals(
            self::MOCK_API_BASE_URL.self::$endpoint.$path,
            $request->getUri()->__toString()
        );
    }
}
